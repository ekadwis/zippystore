<?php

namespace App\Controllers;

use App\Models\SosmedOrderModel;
use App\Models\SosmedLayananModel;
use App\Models\CanvaOrderModel;
use App\Models\CanvaSettingModel;
use App\Libraries\PaymentGateway\DuitkuService;
use App\Libraries\SprintpediaService;
use App\Libraries\MailerService;

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

        // Deteksi Tipe Order (Canva vs Sosmed)
        if (str_starts_with($orderCode, 'ZP-CNV-')) {
            return $this->processCanvaFulfillment($orderCode, $resultCode, $reference);
        }

        return $this->processSosmedFulfillment($orderCode, $resultCode, $reference);
    }

    /**
     * Pemenuhan Order Canva PRO EDU (Kirim Email Undangan Otomatis)
     */
    protected function processCanvaFulfillment(string $orderCode, string $resultCode, string $reference)
    {
        $canvaModel = new CanvaOrderModel();
        $order = $canvaModel->findByCode($orderCode);

        if (!$order) {
            return $this->response->setStatusCode(404)->setBody('Order Not Found');
        }

        if ($resultCode === '00') {
            if ($order['status_pembayaran'] === 'paid') {
                return $this->response->setBody('OK');
            }

            $settings   = (new CanvaSettingModel())->getSettings();
            $inviteLink = $settings['invite_link'];
            $teamName   = $settings['team_name'] ?: 'AEZ Team';

            // Kirim Email Otomatis
            $mailRes = MailerService::sendCanvaInvite(
                $order['customer_email'],
                $order['order_code'],
                $order['durasi_label'],
                $inviteLink,
                $teamName
            );

            $statusEmail = $mailRes['success'] ? 'sent' : 'failed';
            $emailError  = $mailRes['error'];

            $canvaModel->update($order['id'], [
                'status_pembayaran' => 'paid',
                'status_email'      => $statusEmail,
                'email_error'       => $emailError,
                'invite_link_sent'  => $inviteLink,
                'payment_reference' => $reference,
                'catatan'           => $mailRes['success'] 
                                        ? "Pembayaran QRIS sukses & email link invite berhasil terkirim ke {$order['customer_email']}"
                                        : "Pembayaran sukses, namun gagal kirim email via SMTP",
            ]);

            // Kirim Notifikasi ke Telegram Admin
            try {
                $tg = new \App\Libraries\TelegramChannel();
                if ($tg->isConfigured()) {
                    $msg  = "🎨 *ORDER CANVA PRO EDU MASUK & LUNAS!*\n\n";
                    $msg .= "• *Kode Order:* `{$order['order_code']}`\n";
                    $msg .= "• *Paket:* {$order['durasi_label']}\n";
                    $msg .= "• *Email Customer:* `{$order['customer_email']}`\n";
                    $msg .= "• *Total Bayar:* Rp " . number_format($order['harga'], 0, ',', '.') . " (PAID via QRIS)\n";
                    $msg .= "• *Status Email Invite:* " . strtoupper($statusEmail) . "\n\n";
                    $msg .= "🌐 _Zippy Store Auto Fulfillment System_";
                    $tg->sendMessage($msg);
                }
            } catch (\Throwable $e) {}

            return $this->response->setBody('OK');
        }

        $canvaModel->update($order['id'], [
            'status_pembayaran' => 'expired',
            'catatan'           => 'Pembayaran dibatalkan atau waktu habis',
        ]);

        return $this->response->setBody('OK');
    }

    /**
     * Endpoint Simulasi Bayar untuk Mode Sandbox Sosmed
     */
    public function simulatePay($orderCode)
    {
        $orderModel = new SosmedOrderModel();
        $order = $orderModel->findByCode($orderCode);

        if (! $order) {
            return $this->response->setJSON(['ok' => false, 'msg' => 'Order tidak ditemukan.']);
        }

        $res = $this->processSosmedFulfillment($orderCode, '00', 'SIMULASI-DUITKU-' . time());

        return $this->response->setJSON([
            'ok'      => true,
            'msg'     => 'Simulasi pembayaran sukses berhasil dieksekusi!',
            'order'   => $orderModel->findByCode($orderCode),
        ]);
    }

    /**
     * Logika utama proses bayar -> eksekusi Sprintpedia API (Single & Massal)
     */
    protected function processSosmedFulfillment(string $orderCode, string $resultCode, string $reference)
    {
        $orderModel = new SosmedOrderModel();
        $order = $orderModel->findByCode($orderCode);

        if (! $order) {
            return $this->response->setStatusCode(404)->setBody('Order Not Found');
        }

        if ($resultCode === '00') {
            if ($order['status_pembayaran'] === 'paid' && !empty($order['provider_order_id'])) {
                return $this->response->setBody('OK');
            }

            $updateData = [
                'status_pembayaran' => 'paid',
                'payment_reference' => $reference,
            ];

            $sprintpedia = new SprintpediaService();

            // ORDER MASSAL (BATCH)
            if (!empty($order['is_mass']) && !empty($order['mass_data'])) {
                $massList = json_decode($order['mass_data'], true) ?: [];
                $dispatchedList = [];
                $successIds = [];
                $failedCount = 0;

                foreach ($massList as $item) {
                    $tgt = $item['target'];
                    $qty = (int)$item['jumlah'];
                    $srv = $order['provider_service_id'];

                    $apiRes = $sprintpedia->addOrder($srv, $tgt, $qty);
                    $provId = null;

                    if (!empty($apiRes['success']) && !empty($apiRes['data']['order'])) {
                        $provId = (string)$apiRes['data']['order'];
                        $successIds[] = $provId;
                    } else {
                        $failedCount++;
                    }

                    $dispatchedList[] = [
                        'target'            => $tgt,
                        'jumlah'            => $qty,
                        'provider_order_id' => $provId,
                        'response'          => $apiRes,
                    ];
                }

                $updateData['mass_data']         = json_encode($dispatchedList);
                $updateData['provider_order_id'] = implode(',', $successIds);
                $updateData['status_order']      = (count($successIds) > 0) ? 'processing' : 'failed';
                $updateData['provider_response'] = json_encode(['batch_results' => $dispatchedList]);
                $updateData['catatan']           = "Order massal (" . count($successIds) . " sukses, " . $failedCount . " gagal kirim)";
            } 
            // ORDER SINGLE
            else {
                $serviceId = $order['provider_service_id'];
                $apiResult = $sprintpedia->addOrder($serviceId, $order['target'], (int)$order['jumlah']);

                if (!empty($apiResult['success']) && !empty($apiResult['data']['order'])) {
                    $updateData['provider_order_id'] = (string)$apiResult['data']['order'];
                    $updateData['status_order']      = 'processing';
                    $updateData['catatan']           = 'Pembayaran QRIS sukses & otomatis diproses di server';
                } else {
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
            }

            $orderModel->update($order['id'], $updateData);

            // Kirim Notifikasi Otomatis ke Telegram
            try {
                $tg = new \App\Libraries\TelegramChannel();
                if ($tg->isConfigured()) {
                    $isMass = !empty($order['is_mass']);
                    $provIdText = !empty($updateData['provider_order_id']) ? '#' . $updateData['provider_order_id'] : 'Gagal / Perlu Review';
                    
                    $msg  = $isMass ? "⚡ *ORDER SOSMED MASSAL BERHASIL!*\n\n" : "⚡ *ORDER SOSMED OTOMATIS BERHASIL!*\n\n";
                    $msg .= "• *Kode Order:* `{$order['order_code']}`\n";
                    $msg .= "• *Tipe:* " . ($isMass ? "Massal ({$order['mass_count']} baris target)" : "Single Order") . "\n";
                    $msg .= "• *Layanan:* {$order['layanan_nama']}\n";
                    if ($isMass) {
                        $msg .= "• *Total Akumulasi:* " . number_format($order['jumlah'], 0, ',', '.') . " pcs\n";
                    } else {
                        $msg .= "• *Jumlah:* " . number_format($order['jumlah'], 0, ',', '.') . " pcs\n";
                        $msg .= "• *Target:* `{$order['target']}`\n";
                    }
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
