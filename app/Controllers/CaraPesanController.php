<?php

namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\PengaturanModel;

class CaraPesanController extends BaseController
{
    public function index()
    {
        // Statistik — GANTI angka sesuai data aslimu
        $statistik = [
            ['angka' => '5.000+', 'label' => 'Pesanan Selesai',  'icon' => '📦'],
            ['angka' => '1.200+', 'label' => 'Pelanggan Puas',   'icon' => '😊'],
            ['angka' => '4',      'label' => 'Tahun Pengalaman', 'icon' => '🏆'],
            ['angka' => '24 Jam', 'label' => 'Respon Cepat',     'icon' => '⚡'],
        ];

        // Langkah pemesanan
        $langkah = [
            ['no' => 1, 'judul' => 'Pilih Layanan',   'desc' => 'Tentukan produk atau layanan yang kamu butuhkan — Joki Tugas, App Premium, Sosmed Boost, atau Nomor OTP.'],
            ['no' => 2, 'judul' => 'Chat WhatsApp',   'desc' => 'Hubungi admin kami via WhatsApp. Sampaikan detail pesananmu, admin akan bantu dari awal sampai selesai.'],
            ['no' => 3, 'judul' => 'Lakukan Pembayaran', 'desc' => 'Bayar sesuai harga yang disepakati lewat metode yang tersedia. Mudah, cepat, dan transparan.'],
            ['no' => 4, 'judul' => 'Pesanan Diproses', 'desc' => 'Pesananmu langsung kami kerjakan. Kamu akan menerima hasilnya sesuai estimasi waktu yang dijanjikan.'],
        ];

        return view('cara_pesan/index', [
            'title'      => 'Cara Pemesanan - Zippy Store',
            'statistik'  => $statistik,
            'langkah'    => $langkah,
            'layanan'    => (new LayananModel())->getActive(),
            'pengaturan' => (new PengaturanModel())->getSettings(),
        ]);
    }
}