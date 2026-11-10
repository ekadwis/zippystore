<?php

namespace App\Controllers;

use App\Models\SosmedOrderModel;
use App\Models\SosmedLayananModel;
use App\Libraries\PaymentGateway\DuitkuService;
use App\Libraries\SprintpediaService;

class PaymentCallbackController extends BaseController
{
    /**
     * Webhook Callback dari Duitku
     */
    public function duitku()
    {
        $postData = $this->request->getPost();
        log_message('info', 'Duitku Callback Received: ' . json_encode($postData));

        if (empty($postData)) {
            return $this->response->setStatusCode(400)->setBody('Bad Request: Empty payload');
        }

        $duitku = new DuitkuService();

        // 1. Validasi Signature Duitku
        if (! $duitku->validateCallback($postData)) {
            log_message('error', 'Duitku Callback Signature Mismatch: ' . json_encode($postData));
            return $this->response->setStatusCode(400)->setBody('Invalid Signature');
        }

        $orderCode  = $postData['merchantOrderId'] ?? '';
        $resultCode = $postData['resultCode'] ?? '';
        $reference  = $postData['reference'] ?? '';

        return $this->processOrderFulfillment($orderCode, $resultCode, $reference);
    }

    /**
     * Endpoint Simulasi Bayar untuk Mode Sandbox
     * Bisa diklik oleh kamu saat testing tanpa bayar uang asli
     */
    public function simulatePay($orderCode)
    {
        $orderModel = new SosmedOrderModel();
        $order = $orderModel->findByCode($orderCode);

        if (! $order) {
            return $this->response->setJSON(['ok' => false, 'msg' => 'Order tidak ditemukan.']);
        }

        // Jalankan pemenuhan order seperti layaknya webhook Duitku sukses
        $res = $this->processOrderFulfillment($orderCode, '00', 'SIMULASI-DUITKU-' . time());

        return $this->response->setJSON([
            'ok'      => true,
            'msg'     => 'Simulasi pembayaran sukses berhasil dieksekusi!',
            'order'   => $orderModel->findByCode($orderCode),
        ]);
    }

    /**
     * Logika utama proses bayar -> eksekusi Sprintpedia API
     */
    protected function processOrderFulfillment(string $orderCode, string $resultCode, string $reference)
    {
        $orderModel = new SosmedOrderModel();
        $order = $orderModel->findByCode($orderCode);

        if (! $order) {
            return $this->response->setStatusCode(404)->setBody('Order Not Found');
        }

        if ($resultCode === '00') {
            // Cegah double fulfillment
            if ($order['status_pembayaran'] === 'paid' && !empty($order['provider_order_id'])) {
                return $this->response->setBody('OK');
            }

            $updateData = [
                'status_pembayaran' => 'paid',
                'payment_reference' => $reference,
            ];

            // AUTO DISPATCH KE SPRINTPEDIA API
            $sprintpedia = new SprintpediaService();
            $serviceId   = $order['provider_service_id'];
            $apiResult   = $sprintpedia->addOrder($serviceId, $order['target'], (int)$order['jumlah']);

            if (!empty($apiResult['success']) && !empty($apiResult['data']['order'])) {
                $updateData['provider_order_id'] = (string)$apiResult['data']['order'];
                $updateData['status_order']      = 'processing';
                $updateData['catatan']           = 'Pembayaran QRIS sukses & otomatis diproses di server';
            } else {
                // Alternatif jika ada
                $layananModel = new SosmedLayananModel();
                $layanan = $layananModel->find($order['layanan_id']);

                if (!empty($layanan['provider_service_id_alt'])) {
                    $altId = $layanan['provider_service_id_alt'];
                    $apiResultAlt = $sprintpedia->addOrder($altId, $order['target'], (int)$order['jumlah']);
                    if (!empty($apiResultAlt['success']) && !empty($apiResultAlt['data']['order'])) {
                        $updateData['provider_service_id'] = $altId;
                        $updateData['provider_order_id']   = (string)$apiResultAlt['data']['order'];
                        $updateData['status_order']        = 'processing';
                        $updateData['catatan']             = 'Order diproses menggunakan server cadangan';
                    } else {
                        $updateData['status_order'] = 'failed';
                        $updateData['catatan']      = 'Pembayaran sukses, server provider sedang overload. Hubungi admin.';
                    }
                } else {
                    $updateData['status_order'] = 'failed';
                    $updateData['catatan']      = 'Pembayaran sukses, order gagal dikirim ke provider (cek saldo/stok).';
                }
            }

            $updateData['provider_response'] = json_encode($apiResult);
            $orderModel->update($order['id'], $updateData);

            // Kirim Notifikasi Otomatis ke Telegram
            try {
                $tg = new \App\Libraries\TelegramChannel();
                if ($tg->isConfigured()) {
                    $provIdText = !empty($updateData['provider_order_id']) ? '#' . $updateData['provider_order_id'] : 'Gagal / Perlu Review';
                    $msg  = "⚡ *ORDER SOSMED OTOMATIS BERHASIL!*\n\n";
                    $msg .= "• *Kode Order:* `{$order['order_code']}`\n";
                    $msg .= "• *Layanan:* {$order['layanan_nama']}\n";
                    $msg .= "• *Jumlah:* " . number_format($order['jumlah'], 0, ',', '.') . " pcs\n";
                    $msg .= "• *Target:* `{$order['target']}`\n";
                    $msg .= "• *Total Bayar:* Rp " . number_format($order['harga'], 0, ',', '.') . " (PAID via QRIS)\n";
                    $msg .= "• *WA Pembeli:* " . ($order['wa_buyer'] ?: '-') . "\n";
                    $msg .= "• *ID Server:* `{$provIdText}`\n";
                    $msg .= "• *Status:* " . strtoupper($updateData['status_order']) . "\n\n";
                    $msg .= "🌐 _Zippy Store Auto Fulfillment System_";

                    $tg->sendMessage($msg);
                }
            } catch (\Throwable $e) {
                log_message('error', 'Gagal kirim notif Telegram order: ' . $e->getMessage());
            }

            return $this->response->setBody('OK');
        }

        $orderModel->update($order['id'], [
            'status_pembayaran' => 'expired',
            'catatan'           => 'Pembayaran dibatalkan atau waktu habis',
        ]);

        return $this->response->setBody('OK');
    }
}
