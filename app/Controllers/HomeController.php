<?php

namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\ClientModel;
use App\Models\PengaturanModel;
use App\Models\StatistikModel;
use App\Models\GaleriModel;
use App\Models\TestimoniModel;

class HomeController extends BaseController
{
    public function index()
    {
        $statModel = new StatistikModel();
        $dbStats   = $statModel->getActive();

        // Fallback statistik berbasis identitas.md bila database belum terisi
        $statistik = !empty($dbStats) ? $dbStats : [
            ['icon' => '📅', 'angka' => '5+ Tahun', 'label' => 'Beroperasi Sejak 2019'],
            ['icon' => '📦', 'angka' => '1.000+',  'label' => 'Transaksi Sukses'],
            ['icon' => '⚡', 'angka' => '< 24 Jam', 'label' => 'Respon Pelayanan'],
            ['icon' => '🛡️', 'angka' => '25–30 Hari', 'label' => 'Garansi Akun Premium'],
        ];

        // FAQ umum berbasis SOP identitas.md
        $faqList = [
            [
                'q' => 'Bagaimana alur pemesanan jasa joki tugas, coding, atau olah data?',
                'a' => 'Cukup kirimkan brief, deadline, dan file pendukung via form web atau chat WhatsApp kami. Admin akan segera menghitung estimasi waktu dan fee secara transparan. Setelah deal dan DP minimal 50% atau pembayaran via QRIS selesai, tim spesialis kami langsung mulai pengerjaan.',
            ],
            [
                'q' => 'Apakah ada garansi revisi untuk asistensi tugas?',
                'a' => 'Ya, kami memberikan gratis 1–2 kali revisi minor yang masih sesuai dengan brief dan kesepakatan awal saat pemesanan. Kami memastikan hasil pekerjaan sesuai dengan ekspektasimu.',
            ],
            [
                'q' => 'Bagaimana jika akun aplikasi premium mengalami kendala sebelum masa aktif habis?',
                'a' => 'Setiap pembelian paket bulanan dilindungi garansi aktif 25–30 hari penuh (atau 7 hari untuk paket mingguan). Jika terjadi kendala login, cukup kirim screenshot bukti kendala ke WhatsApp admin. Akun akan segera diperbaiki atau diganti baru via supplier first-hand kami.',
            ],
            [
                'q' => 'Metode pembayaran apa saja yang diterima di Zippy Store?',
                'a' => 'Metode pembayaran utama kami adalah QRIS instan yang mendukung semua e-wallet (GoPay, OVO, Dana, ShopeePay, LinkAja) serta semua aplikasi Mobile Banking. Kami juga menyediakan transfer langsung ke rekening bank BCA dan Bank Mandiri.',
            ],
            [
                'q' => 'Apakah kerahasiaan identitas dan file saya aman?',
                'a' => 'Pasti. Kami beroperasi sebagai mitra digital independen profesional sejak 2019. Seluruh file tugas, data akun, nomor kontak, dan identitas klien dijaga kerahasiaannya secara ketat tanpa pernah dipublikasikan.',
            ],
        ];

        $flashSale = (new \App\Models\FlashSaleModel())->getActiveFlashSale();

        $data = [
            'title'      => 'Zippy Store — Kebutuhan Digital, Aplikasi Premium, & Asistensi Tugas Sejak 2019',
            'layanan'    => (new LayananModel())->getActive(),
            'clients'    => (new ClientModel())->getActive(),
            'statistik'  => $statistik,
            'pengaturan' => (new PengaturanModel())->getSettings(),
            'galeri'     => (new GaleriModel())->getFiltered(),
            'testimoni'  => (new TestimoniModel())->getActive(),
            'faqList'    => $faqList,
            'flashSale'  => $flashSale,
        ];

        return view('home/index', $data);
    }
}