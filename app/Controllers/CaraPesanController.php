<?php

namespace App\Controllers;

use App\Models\PengaturanModel;
use App\Models\StatistikModel;

class CaraPesanController extends BaseController
{
    public function index()
    {
        $langkah = [
            [
                'no'    => 1,
                'judul' => 'Inquiry & Konsultasi Brief',
                'desc'  => 'Pilih layanan yang kamu butuhkan (Asistensi Tugas & IT, Akun Premium, atau Sosmed Growth). Sampaikan brief tugas atau spesifikasi akun yang kamu cari via form web atau WhatsApp resmi.',
            ],
            [
                'no'    => 2,
                'judul' => 'Cek Stok & Estimasi Biaya',
                'desc'  => 'Admin mengecek ketersediaan akun ke supplier tangan pertama (first-hand) atau menganalisis tingkat kesulitan tugas untuk memberikan estimasi durasi dan fee yang transparan.',
            ],
            [
                'no'    => 3,
                'judul' => 'Pembayaran Instan via QRIS',
                'desc'  => 'Lakukan pembayaran di muka (full payment atau DP minimal 50% untuk tugas) via QRIS yang mendukung seluruh e-wallet & mobile banking, atau transfer bank BCA & Mandiri.',
            ],
            [
                'no'    => 4,
                'judul' => 'Pengerjaan & Garansi Aktif',
                'desc'  => 'Pesanan langsung diproses: akun diserahkan, metrik disuntikkan, atau tugas diselesaikan tepat waktu. Dilindungi garansi 25–30 hari (akun) dan revisi minor gratis 1–2 kali (tugas).',
            ],
        ];

        $statModel = new StatistikModel();
        $dbStats   = $statModel->getActive();
        $statistik = !empty($dbStats) ? $dbStats : [
            ['icon' => '📅', 'angka' => '5+ Tahun', 'label' => 'Beroperasi Sejak 2019'],
            ['icon' => '📦', 'angka' => '1.000+',  'label' => 'Transaksi Sukses'],
            ['icon' => '⚡', 'angka' => '< 24 Jam', 'label' => 'Respon Pelayanan'],
            ['icon' => '🛡️', 'angka' => '25–30 Hari', 'label' => 'Garansi Akun Premium'],
        ];

        return view('cara_pesan/index', [
            'title'      => 'Alur Pemesanan & Pembayaran QRIS — Zippy Store',
            'statistik'  => $statistik,
            'langkah'    => $langkah,
            'pengaturan' => (new PengaturanModel())->getSettings(),
        ]);
    }
}