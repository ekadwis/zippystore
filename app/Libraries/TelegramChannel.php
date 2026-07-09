<?php

namespace App\Libraries;

/**
 * TelegramChannel - Menggunakan Telegram Bot API untuk mengambil foto dari channel.
 *
 * Bot harus ditambahkan sebagai admin di channel agar bisa menerima updates.
 * Foto baru akan ditangkap via getUpdates polling atau webhook.
 * Foto di-download ke server dan disimpan ke tabel testimoni.
 */
class TelegramChannel
{
    private string $botToken;
    private string $channelId;
    private string $channelUsername;
    private string $apiBase;

    public function __construct()
    {
        $this->botToken        = env('telegram.botToken', '');
        $this->channelId       = env('telegram.channelId', '');
        $this->channelUsername  = env('telegram.channelUsername', '');
        $this->apiBase         = 'https://api.telegram.org/bot' . $this->botToken;
    }

    /**
     * Panggil Bot API method
     */
    private function callApi(string $method, array $params = []): array
    {
        $url = $this->apiBase . '/' . $method;
        $ch  = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_POST           => !empty($params),
            CURLOPT_POSTFIELDS     => !empty($params) ? http_build_query($params) : null,
        ]);
        $response = curl_exec($ch);
        $error    = curl_error($ch);
        curl_close($ch);

        if ($error) {
            log_message('error', 'Telegram API error: ' . $error);
            return ['ok' => false, 'description' => $error];
        }

        return json_decode($response, true) ?: ['ok' => false, 'description' => 'Invalid JSON'];
    }

    /**
     * Verifikasi bot token valid
     */
    public function verifyBot(): array
    {
        return $this->callApi('getMe');
    }

    /**
     * Dapatkan info channel
     */
    public function getChannelInfo(): array
    {
        $chatId = $this->channelId ?: ('@' . $this->channelUsername);
        return $this->callApi('getChat', ['chat_id' => $chatId]);
    }

    /**
     * Poll getUpdates untuk mendapatkan foto baru dari channel.
     * Mengembalikan array foto yang berhasil diproses.
     */
    public function pollNewPhotos(): array
    {
        // Ambil offset terakhir dari cache
        $cacheFile = WRITEPATH . 'cache/telegram_update_offset.txt';
        $offset    = file_exists($cacheFile) ? (int) file_get_contents($cacheFile) : 0;

        $result = $this->callApi('getUpdates', [
            'offset'          => $offset,
            'limit'           => 100,
            'timeout'         => 5,
            'allowed_updates' => json_encode(['channel_post']),
        ]);

        if (!($result['ok'] ?? false) || empty($result['result'])) {
            return [];
        }

        $photos    = [];
        $maxOffset = $offset;

        foreach ($result['result'] as $update) {
            $maxOffset = max($maxOffset, $update['update_id'] + 1);

            $post = $update['channel_post'] ?? null;
            if (!$post) continue;

            // Pastikan dari channel yang benar
            $chatId = (string) ($post['chat']['id'] ?? '');
            if ($chatId !== $this->channelId) continue;

            // Cek apakah ada foto
            if (!isset($post['photo'])) continue;

            // Ambil resolusi terbesar
            $photo  = end($post['photo']);
            $fileId = $photo['file_id'];

            // Download foto
            $localPath = $this->downloadPhoto($fileId);
            if (!$localPath) continue;

            $photos[] = [
                'message_id' => $post['message_id'],
                'file_id'    => $fileId,
                'local_path' => $localPath,
                'caption'    => $post['caption'] ?? '',
                'date'       => $post['date'] ?? time(),
            ];
        }

        // Simpan offset terbaru
        if ($maxOffset > $offset) {
            file_put_contents($cacheFile, (string) $maxOffset);
        }

        return $photos;
    }

    /**
     * Download foto dari Telegram menggunakan file_id.
     * Menyimpan ke public/uploads/testimoni/
     * @return string|null path relatif dari public/ atau null jika gagal
     */
    public function downloadPhoto(string $fileId): ?string
    {
        // 1. Dapatkan file path dari Telegram
        $fileInfo = $this->callApi('getFile', ['file_id' => $fileId]);
        if (!($fileInfo['ok'] ?? false)) {
            log_message('error', 'Telegram getFile failed: ' . json_encode($fileInfo));
            return null;
        }

        $filePath = $fileInfo['result']['file_path'] ?? '';
        if (empty($filePath)) return null;

        // 2. Download file
        $downloadUrl = 'https://api.telegram.org/file/bot' . $this->botToken . '/' . $filePath;
        $ch = curl_init($downloadUrl);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_FOLLOWLOCATION => true,
        ]);
        $imageData = curl_exec($ch);
        $httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200 || empty($imageData)) {
            log_message('error', 'Telegram download failed: HTTP ' . $httpCode);
            return null;
        }

        // 3. Simpan ke disk
        $uploadDir = FCPATH . 'uploads/testimoni/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $ext      = pathinfo($filePath, PATHINFO_EXTENSION) ?: 'jpg';
        $fileName = 'tg_' . md5($fileId) . '.' . $ext;
        $fullPath = $uploadDir . $fileName;

        if (file_put_contents($fullPath, $imageData) === false) {
            log_message('error', 'Failed to save telegram photo: ' . $fullPath);
            return null;
        }

        return 'uploads/testimoni/' . $fileName;
    }

    /**
     * Sync foto baru dari channel ke tabel testimoni.
     * Panggil ini dari admin panel atau cron job.
     * @return int jumlah foto baru yang disimpan
     */
    public function syncToDatabase(): int
    {
        $photos = $this->pollNewPhotos();
        if (empty($photos)) return 0;

        $db    = \Config\Database::connect();
        $table = 'testimoni';
        $saved = 0;

        foreach ($photos as $photo) {
            // Cek duplikasi berdasarkan file_id
            $exists = $db->table($table)
                         ->where('telegram_file_id', $photo['file_id'])
                         ->countAllResults();
            if ($exists > 0) continue;

            $data = [
                'nama'             => $photo['caption'] ?: 'Testimoni',
                'gambar'           => $photo['local_path'],
                'telegram_file_id' => $photo['file_id'],
                'telegram_msg_id'  => $photo['message_id'],
                'is_active'        => 1,
                'created_at'       => date('Y-m-d H:i:s', $photo['date']),
            ];

            if ($db->table($table)->insert($data)) {
                $saved++;
            }
        }

        return $saved;
    }

    /**
     * Setup webhook (untuk production dengan HTTPS)
     */
    public function setWebhook(string $webhookUrl): array
    {
        return $this->callApi('setWebhook', [
            'url'             => $webhookUrl,
            'allowed_updates' => json_encode(['channel_post']),
        ]);
    }

    /**
     * Hapus webhook
     */
    public function deleteWebhook(): array
    {
        return $this->callApi('deleteWebhook');
    }

    /**
     * Proses incoming webhook update (dipanggil dari controller)
     */
    public function processWebhookUpdate(array $update): ?array
    {
        $post = $update['channel_post'] ?? null;
        if (!$post) return null;

        // Pastikan dari channel yang benar
        $chatId = (string) ($post['chat']['id'] ?? '');
        if ($chatId !== $this->channelId) return null;

        // Cek apakah ada foto
        if (!isset($post['photo'])) return null;

        // Ambil resolusi terbesar
        $photo  = end($post['photo']);
        $fileId = $photo['file_id'];

        // Download foto
        $localPath = $this->downloadPhoto($fileId);
        if (!$localPath) return null;

        // Simpan ke DB
        $db = \Config\Database::connect();
        $data = [
            'nama'             => $post['caption'] ?? 'Testimoni',
            'gambar'           => $localPath,
            'telegram_file_id' => $fileId,
            'telegram_msg_id'  => $post['message_id'],
            'is_active'        => 1,
            'created_at'       => date('Y-m-d H:i:s', $post['date'] ?? time()),
        ];

        // Cek duplikasi
        $exists = $db->table('testimoni')
                     ->where('telegram_file_id', $fileId)
                     ->countAllResults();

        if ($exists > 0) return null;

        $db->table('testimoni')->insert($data);

        return $data;
    }

    /**
     * Cek apakah Bot API tersedia (token valid)
     */
    public function isConfigured(): bool
    {
        return !empty($this->botToken) && !empty($this->channelId);
    }
}