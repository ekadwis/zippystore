<?php

namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\PengaturanModel;

class AboutController extends BaseController
{
    public function index()
    {
        $profile = [
            'brand'        => 'Zippy Store',
            'sebelumnya'   => 'Zippediastore',
            'tahun'        => 2019,
            'domain'       => 'zippystore.my.id',
            'tipe'         => 'Penyedia Layanan Digital Independen (Digital Agency & Freelance Service)',
            'transaksi'    => '1.000–5.000+ Transaksi Sukses',
            'komunitas'    => '200+ Member Komunitas Aktif',
            'target'       => 'Pelajar, Mahasiswa, dan Profesional Muda',
            'respon'       => 'Respon Cepat Maksimal 1x24 Jam',
            'pembayaran'   => 'QRIS Instan (Semua E-Wallet & Bank)',
        ];

        $data = [
            'title'      => 'Tentang Zippy Store — Profil Bisnis & Perjalanan Sejak 2019',
            'layanan'    => (new LayananModel())->getActive(),
            'pengaturan' => (new PengaturanModel())->getSettings(),
            'profile'    => $profile,
        ];

        return view('about/index', $data);
    }
}