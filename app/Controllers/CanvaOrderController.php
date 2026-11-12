<?php

namespace App\Controllers;

use App\Models\CanvaOrderModel;
use App\Models\CanvaSettingModel;
use App\Models\PengaturanModel;
use App\Libraries\PaymentGateway\DuitkuService;
use App\Libraries\MailerService;

class CanvaOrderController extends BaseController
{
    protected $orderModel;
    protected $settingModel;

    public function __construct()
    {
        $this->orderModel   = new CanvaOrderModel();
        $this->settingModel = new CanvaSettingModel();
        helper(['url', 'form']);
    }

    /**
     * Halaman Checkout Canva PRO EDU
     */
    public function index()
    {
        $settings = $this->settingModel->getSettings();
        $set = (new PengaturanModel())->getSettings();

        // 4 Pilihan Durasi & Harga:
        // 1 bulan: 3k, 3 bulan: 6k, 6 bulan: 10k, 12 bulan: 15k
        $paketList = [
            ['bulan' => 1,  'label' => '1 Bulan (Garansi 25-30 Hari)', 'harga' => 3000,  'badge' => 'Populer'],
            ['bulan' => 3,  'label' => '3 Bulan (Garansi Penuh)',       'harga' => 6000,  'badge' => 'Hemat'],
            ['bulan' => 6,  'label' => '6 Bulan (Garansi Penuh)',       'harga' => 10000, 'badge' => 'Super Deal'],
            ['bulan' => 12, 'label' => '12 Bulan / 1 Tahun',            'harga' => 15000, 'badge' => 'Best Value 🔥'],
        ];

        return view('premium/canva', [
            'title'      => 'Order Canva PRO EDU - Otomatis Invite Email',
            'settings'   => $settings,
            'paketList'  => $paketList,
            'pengaturan' => $set,
        ]);
    }

    /**
     * AJAX Submit Order -> Request Duitku QRIS
     */
    public function submit()
    {
        $emailCustomer = trim($this->request->getPost('email') ?? '');
        $waCustomer    = trim($this->request->getPost('wa') ?? '');
        $durasiBulan   = (int)$this->request->getPost('durasi_bulan');

        if (empty($emailCustomer) || !filter_var($emailCustomer, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setJSON(['ok' => false, 'msg' => 'Email Canva yang valid wajib diisi.']);
        }

        $hargaMap = [
            1  => ['label' => '1 Bulan (Garansi 25-30 Hari)', 'harga' => 3000],
            3  => ['label' => '3 Bulan (Garansi Penuh)',       'harga' => 6000],
            6  => ['label' => '6 Bulan (Garansi Penuh)',       'harga' => 10000],
            12 => ['label' => '12 Bulan / 1 Tahun',            'harga' => 15000],
        ];

        if (!isset($hargaMap[$durasiBulan])) {
            return $this->response->setJSON(['ok' => false, 'msg' => 'Pilihan durasi tidak valid.']);
        }

        $selected = $hargaMap[$durasiBulan];
        $settings = $this->settingModel->getSettings();
        $orderCode = 'ZP-CNV-' . date('ymd') . strtoupper(substr(uniqid(), -4));

        // Request QRIS ke Duitku
        $duitku = new DuitkuService();
        $duitkuRes = $duitku->createInvoice(
            $orderCode,
            $selected['harga'],
            'SP', // QRIS
            "Canva PRO EDU ({$selected['label']})",
            [
                'name'  => 'Customer Canva',
                'email' => $emailCustomer,
                'phone' => $waCustomer ?: '085177838705',
            ],
            base_url('callback'),
            base_url('premium/canva')
        );

        $paymentUrl = null;
        $reference  = null;
        $qrString   = null;

        if (!empty($duitkuRes['success']) && !empty($duitkuRes['data']['paymentUrl'])) {
            $paymentUrl = $duitkuRes['data']['paymentUrl'];
            $reference  = $duitkuRes['data']['reference'] ?? null;
            $qrString   = $duitkuRes['data']['qrString'] ?? null;
        }

        // Simpan Order Canva
        $this->orderModel->insert([
            'order_code'        => $orderCode,
            'customer_email'    => $emailCustomer,
            'customer_wa'       => $waCustomer,
            'durasi_label'      => $selected['label'],
            'durasi_bulan'      => $durasiBulan,
            'harga'             => $selected['harga'],
            'invite_link_sent'  => $settings['invite_link'],
            'status_pembayaran' => 'unpaid',
            'status_email'      => 'pending',
            'payment_reference' => $reference,
            'payment_url'       => $paymentUrl,
            'payment_method'    => 'QRIS',
            'catatan'           => 'Menunggu pembayaran QRIS untuk aktivasi Canva PRO EDU',
        ]);

        return $this->response->setJSON([
            'ok'          => true,
            'order_code'  => $orderCode,
            'payment_url' => $paymentUrl,
            'qr_string'   => $qrString,
            'harga_fmt'   => 'Rp ' . number_format($selected['harga'], 0, ',', '.'),
            'durasi'      => $selected['label'],
            'email'       => $emailCustomer,
        ]);
    }

    /**
     * AJAX Cek Status Pembayaran Realtime
     */
    public function checkStatus($orderCode)
    {
        $order = $this->orderModel->findByCode($orderCode);
        if (!$order) {
            return $this->response->setJSON(['ok' => false, 'msg' => 'Order tidak ditemukan.']);
        }

        return $this->response->setJSON([
            'ok'                => true,
            'order_code'        => $order['order_code'],
            'status_pembayaran' => $order['status_pembayaran'],
            'status_email'      => $order['status_email'],
            'invite_link'       => ($order['status_pembayaran'] === 'paid') ? $order['invite_link_sent'] : null,
            'catatan'           => $order['catatan'],
        ]);
    }

    /**
     * Endpoint Simulasi Bayar Khusus Sandbox
     */
    public function simulatePay($orderCode)
    {
        $order = $this->orderModel->findByCode($orderCode);
        if (!$order) {
            return $this->response->setJSON(['ok' => false, 'msg' => 'Order tidak ditemukan.']);
        }

        if ($order['status_pembayaran'] === 'paid') {
            return $this->response->setJSON(['ok' => true, 'msg' => 'Order sudah lunas sebelumnya.']);
        }

        $settings = $this->settingModel->getSettings();
        $inviteLink = $settings['invite_link'];
        $teamName   = $settings['team_name'] ?: 'AEZ Team';

        // 1. Kirim Email Undangan Otomatis
        $mailRes = MailerService::sendCanvaInvite(
            $order['customer_email'],
            $order['order_code'],
            $order['durasi_label'],
            $inviteLink,
            $teamName
        );

        $statusEmail = $mailRes['success'] ? 'sent' : 'failed';
        $emailError  = $mailRes['error'];

        // 2. Update Database
        $this->orderModel->update($order['id'], [
            'status_pembayaran' => 'paid',
            'status_email'      => $statusEmail,
            'email_error'       => $emailError,
            'invite_link_sent'  => $inviteLink,
            'payment_reference' => 'SIMULASI-CANVA-' . time(),
            'catatan'           => $mailRes['success'] 
                                    ? "Pembayaran sukses & email link invite berhasil terkirim ke {$order['customer_email']}"
                                    : "Pembayaran sukses, namun gagal kirim email (cek kredensial SMTP)",
        ]);

        return $this->response->setJSON([
            'ok'           => true,
            'msg'          => 'Simulasi pembayaran Canva berhasil diverifikasi!',
            'email_status' => $statusEmail,
        ]);
    }
}
