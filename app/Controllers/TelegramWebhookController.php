<?php

namespace App\Controllers;

use App\Libraries\TelegramChannel;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * TelegramWebhookController
 *
 * Menerima incoming update dari Telegram Bot API (webhook mode).
 * Endpoint: POST /webhook/telegram
 *
 * Untuk production (HTTPS), daftarkan webhook:
 *   https://api.telegram.org/bot{TOKEN}/setWebhook?url=https://yourdomain.com/webhook/telegram
 *
 * Pastikan bot sudah ditambahkan sebagai admin di channel.
 */
class TelegramWebhookController extends BaseController
{
    public function handle(): ResponseInterface
    {
        // Ambil raw JSON dari Telegram
        $rawBody = $this->request->getBody();
        $update  = json_decode($rawBody, true);

        if (empty($update)) {
            return $this->response->setStatusCode(400)->setJSON(['status' => 'invalid payload']);
        }

        $telegram = new TelegramChannel();
        $result   = $telegram->processWebhookUpdate($update);

        if ($result !== null) {
            log_message('info', 'Telegram webhook: saved new testimoni - ' . json_encode($result));
            return $this->response->setJSON(['status' => 'ok', 'saved' => true]);
        }

        return $this->response->setJSON(['status' => 'ok', 'saved' => false]);
    }

    /**
     * Setup webhook - panggil sekali saat deploy ke production
     * GET /admin/telegram/setup-webhook
     */
    public function setupWebhook(): ResponseInterface
    {
        $telegram   = new TelegramChannel();
        $webhookUrl = site_url('webhook/telegram');
        $result     = $telegram->setWebhook($webhookUrl);

        return $this->response->setJSON([
            'webhook_url' => $webhookUrl,
            'result'      => $result,
        ]);
    }

    /**
     * Hapus webhook (beralih ke polling mode)
     * GET /admin/telegram/delete-webhook
     */
    public function deleteWebhook(): ResponseInterface
    {
        $telegram = new TelegramChannel();
        $result   = $telegram->deleteWebhook();

        return $this->response->setJSON($result);
    }

    /**
     * Status bot & channel
     * GET /admin/telegram/status
     */
    public function status(): ResponseInterface
    {
        $telegram = new TelegramChannel();

        return $this->response->setJSON([
            'bot'     => $telegram->verifyBot(),
            'channel' => $telegram->getChannelInfo(),
        ]);
    }
}