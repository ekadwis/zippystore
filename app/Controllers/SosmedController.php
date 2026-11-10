<?php

namespace App\Controllers;

use App\Models\SosmedPlatformModel;
use App\Models\SosmedLayananModel;
use App\Models\SosmedPaketModel;
use App\Models\SosmedOrderModel;
use App\Models\PengaturanModel;
use App\Libraries\PaymentGateway\DuitkuService;
use App\Libraries\SprintpediaService;

class SosmedController extends BaseController
{
    protected $platformModel;
    protected $layananModel;
    protected $paketModel;
    protected $orderModel;

    public function __construct()
    {
        $this->platformModel = new SosmedPlatformModel();
        $this->layananModel  = new SosmedLayananModel();
        $this->paketModel    = new SosmedPaketModel();
        $this->orderModel    = new SosmedOrderModel();
        helper(['sosmed', 'url']);
    }

    public function index()
    {
        $platforms = $this->platformModel->getActive();
        $struktur  = [];

        foreach ($platforms as $p) {
            $layanans = $this->layananModel->getByPlatform($p['id']);
            $layananArr = [];
            foreach ($layanans as $l) {
                $pakets = $this->paketModel->getByLayanan($l['id']);
                if (! empty($pakets)) {
                    $layananArr[] = [
                        'info'   => $l,
                        'pakets' => $pakets,
                    ];
                }
            }
            if (! empty($layananArr)) {
                $struktur[] = ['platform' => $p, 'layanans' => $layananArr];
            }
        }

        // Data layanan untuk form & kalkulator
        $layananFlat = $this->layananModel->getWithPlatform(true);

        return view('sosmed/index', [
            'title'       => 'Sosmed Boost & Growth - Zippy Store',
            'struktur'    => $struktur,
            'layananFlat' => $layananFlat,
            'pengaturan'  => (new PengaturanModel())->getSettings(),
        ]);
    }

    /**
     * AJAX Kalkulasi Harga
     */
    public function hitung()
    {
        $layananId = (int) $this->request->getPost('layanan_id');
        $jumlah    = (int) $this->request->getPost('jumlah');

        $layanan = $this->layananModel->find($layananId);
        if (! $layanan || ! $layanan['is_active']) {
            return $this->response->setJSON(['ok' => false, 'msg' => 'Layanan tidak tersedia.']);
        }

        if ($jumlah < (int) $layanan['min_order'] || $jumlah > (int) $layanan['max_order']) {
            return $this->response->setJSON([
                'ok'  => false,
                'msg' => "Jumlah harus antara " . number_format($layanan['min_order'], 0, ',', '.') .
                         " - " . number_format($layanan['max_order'], 0, ',', '.') . ".",
            ]);
        }

        $isViews = (stripos($layanan['nama'], 'views') !== false || stripos($layanan['slug'], 'views') !== false);
        $pakets  = $this->paketModel->getByLayanan($layananId);

        $hasil = hitung_harga_sosmed($pakets, $jumlah, $isViews);

        return $this->response->setJSON([
            'ok'        => true,
            'harga'     => $hasil['harga'],
            'harga_fmt' => 'Rp ' . number_format($hasil['harga'], 0, ',', '.'),
            'jumlah'    => $jumlah,
            'layanan'   => $layanan['nama'],
            'tier'      => $hasil['tier'],
        ]);
    }

    /**
     * AJAX Submit Order (Buat Invoice Duitku QRIS)
     */
    public function order()
    {
        $layananId = (int) $this->request->getPost('layanan_id');
        $jumlah    = (int) $this->request->getPost('jumlah');
        $target    = trim($this->request->getPost('target') ?? '');
        $waBuyer   = trim($this->request->getPost('wa_buyer') ?? '');

        if (empty($target)) {
            return $this->response->setJSON(['ok' => false, 'msg' => 'Target (Link Akun / Link Video / Username) wajib diisi.']);
        }

        $layanan = $this->layananModel->find($layananId);
        if (! $layanan || ! $layanan['is_active']) {
            return $this->response->setJSON(['ok' => false, 'msg' => 'Layanan yang dipilih tidak aktif.']);
        }

        if ($jumlah < (int) $layanan['min_order'] || $jumlah > (int) $layanan['max_order']) {
            return $this->response->setJSON([
                'ok'  => false,
                'msg' => "Jumlah tidak sesuai ketentuan (" . number_format($layanan['min_order']) . " - " . number_format($layanan['max_order']) . ").",
            ]);
        }

        $platform = $this->platformModel->find($layanan['platform_id']);
        $platformNama = $platform['nama'] ?? 'Sosmed';

        // Hitung harga
        $isViews = (stripos($layanan['nama'], 'views') !== false || stripos($layanan['slug'], 'views') !== false);
        $pakets  = $this->paketModel->getByLayanan($layananId);
        $calc    = hitung_harga_sosmed($pakets, $jumlah, $isViews);
        $totalHarga = $calc['harga'];

        // Kode Unik Order Zippy Store
        $orderCode = 'ZP-SM-' . date('ymd') . strtoupper(substr(uniqid(), -4));

        // 1. Request Invoice Pembayaran ke Duitku (Metode QRIS: 'SP')
        $duitku = new DuitkuService();
        $duitkuRes = $duitku->createInvoice(
            $orderCode,
            $totalHarga,
            'SP',
            "{$layanan['nama']} ({$jumlah} pcs)",
            [
                'name'  => 'Pelanggan Zippy Store',
                'email' => 'buyer@zippystore.my.id',
                'phone' => $waBuyer ?: '085177838705',
            ]
        );

        $paymentUrl = null;
        $reference  = null;
        $qrString   = null;

        if (!empty($duitkuRes['success']) && !empty($duitkuRes['data']['paymentUrl'])) {
            $paymentUrl = $duitkuRes['data']['paymentUrl'];
            $reference  = $duitkuRes['data']['reference'] ?? null;
            $qrString   = $duitkuRes['data']['qrString'] ?? null;
        }

        // 2. Simpan order ke database dengan status UNPAID
        $orderData = [
            'order_code'          => $orderCode,
            'platform_nama'       => $platformNama,
            'layanan_id'          => $layanan['id'],
            'layanan_nama'        => $layanan['nama'],
            'target'              => $target,
            'jumlah'              => $jumlah,
            'harga'               => $totalHarga,
            'wa_buyer'            => $waBuyer,
            'provider_service_id' => $layanan['provider_service_id'],
            'provider_order_id'   => null,
            'status_order'        => 'pending',
            'status_pembayaran'   => 'unpaid',
            'payment_reference'   => $reference,
            'payment_url'         => $paymentUrl,
            'payment_method'      => 'QRIS',
            'catatan'             => 'Menunggu pembayaran QRIS dari pembeli',
        ];

        $this->orderModel->insert($orderData);

        return $this->response->setJSON([
            'ok'          => true,
            'order_code'  => $orderCode,
            'payment_url' => $paymentUrl,
            'qr_string'   => $qrString,
            'harga_fmt'   => 'Rp ' . number_format($totalHarga, 0, ',', '.'),
            'layanan'     => $layanan['nama'],
            'target'      => $target,
            'jumlah'      => $jumlah,
            'msg'         => 'Invoice pembayaran QRIS berhasil dibuat!',
        ]);
    }

    /**
     * AJAX Cek Status Order & Status Pembayaran Realtime
     */
    public function statusOrder($code)
    {
        $order = $this->orderModel->findByCode($code);
        if (! $order) {
            return $this->response->setJSON(['ok' => false, 'msg' => 'Pesanan tidak ditemukan.']);
        }

        return $this->response->setJSON([
            'ok'                => true,
            'order_code'        => $order['order_code'],
            'status_pembayaran' => $order['status_pembayaran'],
            'status_order'      => $order['status_order'],
            'provider_order_id' => $order['provider_order_id'],
            'catatan'           => $order['catatan'],
        ]);
    }
}
