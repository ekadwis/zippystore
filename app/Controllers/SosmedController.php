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

        $layananFlat = $this->layananModel->getWithPlatform(true);

        return view('sosmed/index', [
            'title'       => 'Sosmed Boost & Growth - Zippy Store',
            'struktur'    => $struktur,
            'layananFlat' => $layananFlat,
            'pengaturan'  => (new PengaturanModel())->getSettings(),
        ]);
    }

    /**
     * AJAX Kalkulasi Harga (Mendukung Single & Massal)
     */
    public function hitung()
    {
        $layananId = (int) $this->request->getPost('layanan_id');
        $isMass    = (int) $this->request->getPost('is_mass');

        $layanan = $this->layananModel->find($layananId);
        if (! $layanan || ! $layanan['is_active']) {
            return $this->response->setJSON(['ok' => false, 'msg' => 'Layanan tidak tersedia.']);
        }

        $platform = $this->platformModel->find($layanan['platform_id']);
        $platformSlug = strtolower($platform['slug'] ?? '');
        $isIgTtViews = (in_array($platformSlug, ['instagram', 'tiktok']) && (stripos($layanan['nama'], 'views') !== false || stripos($layanan['slug'], 'views') !== false));
        $pakets  = $this->paketModel->getByLayanan($layananId);

        // KASUS MASSAL
        if ($isMass === 1) {
            $rawLines = trim($this->request->getPost('mass_input') ?? '');
            if (empty($rawLines)) {
                return $this->response->setJSON(['ok' => false, 'msg' => 'Input orderan massal masih kosong.']);
            }

            $lines = array_filter(array_map('trim', explode("\n", $rawLines)));
            if (count($lines) > 50) {
                return $this->response->setJSON(['ok' => false, 'msg' => 'Maksimal 50 baris/target per sekali submit.']);
            }

            $parsed = [];
            $totalHarga = 0;
            $totalJumlah = 0;
            $rowErrors = [];

            foreach ($lines as $idx => $line) {
                $lineNum = $idx + 1;
                // Format: link|jumlah atau link,jumlah atau link spasi jumlah
                $parts = preg_split('/[|,;\s]+/', $line);
                if (count($parts) < 2) {
                    $rowErrors[] = "Baris #{$lineNum}: Format salah. Gunakan format 'link|jumlah'.";
                    continue;
                }

                $qty = (int) end($parts);
                array_pop($parts);
                $target = trim(implode(' ', $parts));

                if (empty($target)) {
                    $rowErrors[] = "Baris #{$lineNum}: Target link/username tidak valid.";
                    continue;
                }

                if ($qty < (int) $layanan['min_order'] || $qty > (int) $layanan['max_order']) {
                    $rowErrors[] = "Baris #{$lineNum}: Jumlah {$qty} di luar batas min/max (" . number_format($layanan['min_order']) . " - " . number_format($layanan['max_order']) . ").";
                    continue;
                }

                $calc = hitung_harga_sosmed($pakets, $qty, $isIgTtViews);
                $subHarga = $calc['harga'];

                $totalHarga += $subHarga;
                $totalJumlah += $qty;

                $parsed[] = [
                    'line'      => $lineNum,
                    'target'    => $target,
                    'jumlah'    => $qty,
                    'harga'     => $subHarga,
                    'harga_fmt' => 'Rp ' . number_format($subHarga, 0, ',', '.'),
                ];
            }

            if (!empty($rowErrors)) {
                return $this->response->setJSON([
                    'ok'     => false,
                    'msg'    => implode("<br>", array_slice($rowErrors, 0, 5)) . (count($rowErrors) > 5 ? "<br>...dan kesalahan lainnya." : ""),
                    'errors' => $rowErrors,
                ]);
            }

            return $this->response->setJSON([
                'ok'           => true,
                'is_mass'      => true,
                'count'        => count($parsed),
                'total_jumlah' => $totalJumlah,
                'harga'        => $totalHarga,
                'harga_fmt'    => 'Rp ' . number_format($totalHarga, 0, ',', '.'),
                'layanan'      => $layanan['nama'],
                'items'        => $parsed,
            ]);
        }

        // KASUS SINGLE
        $jumlah = (int) $this->request->getPost('jumlah');
        if ($jumlah < (int) $layanan['min_order'] || $jumlah > (int) $layanan['max_order']) {
            return $this->response->setJSON([
                'ok'  => false,
                'msg' => "Jumlah harus antara " . number_format($layanan['min_order'], 0, ',', '.') .
                         " - " . number_format($layanan['max_order'], 0, ',', '.') . ".",
            ]);
        }

        $hasil = hitung_harga_sosmed($pakets, $jumlah, $isIgTtViews);

        return $this->response->setJSON([
            'ok'        => true,
            'is_mass'   => false,
            'harga'     => $hasil['harga'],
            'harga_fmt' => 'Rp ' . number_format($hasil['harga'], 0, ',', '.'),
            'jumlah'    => $jumlah,
            'layanan'   => $layanan['nama'],
            'tier'      => $hasil['tier'],
        ]);
    }

    /**
     * AJAX Submit Order (Buat Invoice Duitku QRIS untuk Single & Massal)
     */
    public function order()
    {
        $layananId = (int) $this->request->getPost('layanan_id');
        $isMass    = (int) $this->request->getPost('is_mass');
        $waBuyer   = trim($this->request->getPost('wa_buyer') ?? '');

        $layanan = $this->layananModel->find($layananId);
        if (! $layanan || ! $layanan['is_active']) {
            return $this->response->setJSON(['ok' => false, 'msg' => 'Layanan yang dipilih tidak aktif.']);
        }

        $platform = $this->platformModel->find($layanan['platform_id']);
        $platformNama = $platform['nama'] ?? 'Sosmed';
        $platform = $this->platformModel->find($layanan['platform_id']);
        $platformSlug = strtolower($platform['slug'] ?? '');
        $isIgTtViews = (in_array($platformSlug, ['instagram', 'tiktok']) && (stripos($layanan['nama'], 'views') !== false || stripos($layanan['slug'], 'views') !== false));
        $pakets  = $this->paketModel->getByLayanan($layananId);

        $orderCode = 'ZP-SM-' . date('ymd') . strtoupper(substr(uniqid(), -4));
        $targetField = '';
        $massDataJson = null;
        $massCount = 1;
        $totalJumlah = 0;
        $totalHarga = 0;

        // JIKA ORDER MASSAL
        if ($isMass === 1) {
            $rawLines = trim($this->request->getPost('mass_input') ?? '');
            $lines = array_filter(array_map('trim', explode("\n", $rawLines)));

            if (empty($lines)) {
                return $this->response->setJSON(['ok' => false, 'msg' => 'Data orderan massal tidak boleh kosong.']);
            }
            if (count($lines) > 50) {
                return $this->response->setJSON(['ok' => false, 'msg' => 'Maksimal 50 target sekali checkout.']);
            }

            $massList = [];
            foreach ($lines as $idx => $line) {
                $parts = preg_split('/[|,;\s]+/', $line);
                if (count($parts) < 2) continue;

                $qty = (int) end($parts);
                array_pop($parts);
                $tgt = trim(implode(' ', $parts));

                if (empty($tgt) || $qty < (int)$layanan['min_order'] || $qty > (int)$layanan['max_order']) {
                    return $this->response->setJSON(['ok' => false, 'msg' => "Terdapat baris target/jumlah yang tidak sesuai ketentuan."]);
                }

                $calc = hitung_harga_sosmed($pakets, $qty, $isIgTtViews);
                $totalHarga  += $calc['harga'];
                $totalJumlah += $qty;

                $massList[] = [
                    'target' => $tgt,
                    'jumlah' => $qty,
                    'harga'  => $calc['harga'],
                ];
            }

            $massCount    = count($massList);
            $targetField  = "Batch Order ({$massCount} Target/Konten)";
            $massDataJson = json_encode($massList);
        } 
        // JIKA ORDER SINGLE
        else {
            $target = trim($this->request->getPost('target') ?? '');
            $jumlah = (int) $this->request->getPost('jumlah');

            if (empty($target)) {
                return $this->response->setJSON(['ok' => false, 'msg' => 'Target (Link Akun / Link Video / Username) wajib diisi.']);
            }
            if ($jumlah < (int) $layanan['min_order'] || $jumlah > (int) $layanan['max_order']) {
                return $this->response->setJSON([
                    'ok'  => false,
                    'msg' => "Jumlah tidak sesuai ketentuan (" . number_format($layanan['min_order']) . " - " . number_format($layanan['max_order']) . ").",
                ]);
            }

            $calc = hitung_harga_sosmed($pakets, $jumlah, $isIgTtViews);
            $totalHarga  = $calc['harga'];
            $totalJumlah = $jumlah;
            $targetField = $target;
        }

        // Request Invoice Pembayaran ke Duitku (QRIS)
        $duitku = new DuitkuService();
        $duitkuRes = $duitku->createInvoice(
            $orderCode,
            $totalHarga,
            'SP',
            "{$layanan['nama']} (" . ($isMass ? "Massal {$massCount} target" : "{$totalJumlah} pcs") . ")",
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

        // Simpan ke Database
        $orderData = [
            'order_code'          => $orderCode,
            'is_mass'             => $isMass,
            'mass_data'           => $massDataJson,
            'mass_count'          => $massCount,
            'platform_nama'       => $platformNama,
            'layanan_id'          => $layanan['id'],
            'layanan_nama'        => $layanan['nama'],
            'target'              => $targetField,
            'jumlah'              => $totalJumlah,
            'harga'               => $totalHarga,
            'wa_buyer'            => $waBuyer,
            'provider_service_id' => $layanan['provider_service_id'],
            'provider_order_id'   => null,
            'status_order'        => 'pending',
            'status_pembayaran'   => 'unpaid',
            'payment_reference'   => $reference,
            'payment_url'         => $paymentUrl,
            'payment_method'      => 'QRIS',
            'catatan'             => $isMass ? "Menunggu pembayaran QRIS untuk order massal ({$massCount} target)" : 'Menunggu pembayaran QRIS dari pembeli',
        ];

        $this->orderModel->insert($orderData);

        return $this->response->setJSON([
            'ok'          => true,
            'is_mass'     => ($isMass === 1),
            'mass_count'  => $massCount,
            'order_code'  => $orderCode,
            'payment_url' => $paymentUrl,
            'qr_string'   => $qrString,
            'harga_fmt'   => 'Rp ' . number_format($totalHarga, 0, ',', '.'),
            'layanan'     => $layanan['nama'],
            'target'      => $targetField,
            'jumlah'      => $totalJumlah,
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
            'is_mass'           => !empty($order['is_mass']),
            'mass_count'        => $order['mass_count'] ?? 1,
            'status_pembayaran' => $order['status_pembayaran'],
            'status_order'      => $order['status_order'],
            'provider_order_id' => $order['provider_order_id'],
            'catatan'           => $order['catatan'],
        ]);
    }
}
