<?php

namespace App\Libraries;

/**
 * SprintpediaService
 * Client untuk berinteraksi dengan API SMM Panel Sprintpedia.id (v2)
 */
class SprintpediaService
{
    protected string $apiUrl = 'https://sprintpedia.id/api/v2';
    protected string $apiKey;

    public function __construct(?string $apiKey = null)
    {
        // Prioritas API Key: parameter konstruktor -> .env -> default
        $this->apiKey = $apiKey ?: (getenv('SPRINTPEDIA_API_KEY') ?: '7e1cd0-364b7a-dfbf8d-5fdf9e-bfca51');
    }

    /**
     * Kirim request POST ke API Sprintpedia
     */
    protected function request(array $params): array
    {
        $params['key'] = $this->apiKey;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($ch);
        $error    = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($error) {
            return [
                'success' => false,
                'error'   => 'cURL Error: ' . $error,
                'raw'     => null,
            ];
        }

        $decoded = json_decode($response, true);

        if ($httpCode !== 200 || !is_array($decoded)) {
            return [
                'success'   => false,
                'http_code' => $httpCode,
                'error'     => $decoded['error'] ?? 'Gagal memproses respon dari Sprintpedia',
                'raw'       => $response,
            ];
        }

        return [
            'success' => !isset($decoded['error']),
            'data'    => $decoded,
            'raw'     => $response,
        ];
    }

    /**
     * Cek Saldo Akun Sprintpedia
     */
    public function getBalance(): array
    {
        return $this->request(['action' => 'balance']);
    }

    /**
     * Ambil Daftar Seluruh Layanan
     */
    public function getServices(): array
    {
        return $this->request(['action' => 'services']);
    }

    /**
     * Buat Pesanan Baru (Add Order)
     *
     * @param int|string $serviceId ID Layanan di Sprintpedia
     * @param string     $target    Link video / URL profil / username target
     * @param int        $quantity  Jumlah pesanan
     * @param array      $extra     Parameter tambahan (misal custom_comments jika ada)
     */
    public function addOrder($serviceId, string $target, int $quantity, array $extra = []): array
    {
        $params = array_merge([
            'action'   => 'add',
            'service'  => $serviceId,
            'link'     => $target,
            'quantity' => $quantity,
        ], $extra);

        return $this->request($params);
    }

    /**
     * Cek Status Pesanan Tunggal
     *
     * @param int|string $orderId ID Order dari Sprintpedia
     */
    public function getStatus($orderId): array
    {
        return $this->request([
            'action' => 'status',
            'order'  => $orderId,
        ]);
    }

    /**
     * Cek Status Pesanan Majemuk (Hingga 100 ID sekaligus)
     *
     * @param array|string $orderIds Array ID atau string terpisah koma
     */
    public function getMultipleStatus($orderIds): array
    {
        $ids = is_array($orderIds) ? implode(',', $orderIds) : $orderIds;

        return $this->request([
            'action' => 'status',
            'orders' => $ids,
        ]);
    }

    /**
     * Request Refill untuk order tertentu
     */
    public function createRefill($orderId): array
    {
        return $this->request([
            'action' => 'refill',
            'order'  => $orderId,
        ]);
    }

    /**
     * Request Cancel untuk order tertentu
     */
    public function cancelOrder($orderIds): array
    {
        $ids = is_array($orderIds) ? implode(',', $orderIds) : $orderIds;

        return $this->request([
            'action' => 'cancel',
            'orders' => $ids,
        ]);
    }
}

