<?php

namespace App\Controllers;

use App\Models\PengaturanModel;
use App\Models\StatistikModel;

class CaraPesanController extends BaseController
{
    public function index()
    {
        $langkah = [
            ['no' => 1, 'judul' => 'Pilih Layanan',      'desc' => 'Tentukan produk atau layanan yang kamu butuhkan — Joki Tugas, App Premium, Sosmed Boost, atau Nomor OTP.'],
            ['no' => 2, 'judul' => 'Chat WhatsApp',      'desc' => 'Hubungi admin kami via WhatsApp. Sampaikan detail pesananmu, admin akan bantu dari awal sampai selesai.'],
            ['no' => 3, 'judul' => 'Lakukan Pembayaran', 'desc' => 'Bayar sesuai harga yang disepakati lewat metode yang tersedia. Mudah, cepat, dan transparan.'],
            ['no' => 4, 'judul' => 'Pesanan Diproses',   'desc' => 'Pesananmu langsung kami kerjakan. Kamu akan menerima hasilnya sesuai estimasi waktu yang dijanjikan.'],
        ];

        return view('cara_pesan/index', [
            'title'      => 'Cara Pemesanan - Zippy Store',
            'statistik'  => (new StatistikModel())->getActive(),
            'langkah'    => $langkah,
            'pengaturan' => (new PengaturanModel())->getSettings(),
        ]);
    }
}