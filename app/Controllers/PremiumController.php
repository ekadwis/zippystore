<?php

namespace App\Controllers;

use App\Models\PremiumProdukModel;
use App\Models\PremiumDurasiModel;
use App\Models\PengaturanModel;

class PremiumController extends BaseController
{
    public function index()
    {
        $produkModel = new PremiumProdukModel();
        $durasiModel = new PremiumDurasiModel();

        $produks  = $produkModel->getActive();
        $struktur = [];
        foreach ($produks as $p) {
            $durasi = $durasiModel->getByProduk($p['id']);
            if (! empty($durasi)) {
                $struktur[] = ['produk' => $p, 'durasi' => $durasi];
            }
        }

        $set = (new PengaturanModel())->getSettings();
        $wa  = !empty($set['no_wa']) ? preg_replace('/[^0-9]/', '', $set['no_wa']) : '6285177838705';

        $regulasi = [
            'Penyediaan Akun Legal & Terverifikasi: Seluruh akun disediakan melalui jaringan supplier tangan pertama (first-hand) untuk memastikan stabilitas dan keamanan penggunaan.',
            'Masa Garansi Penuh 25–30 Hari: Pembelian paket 1 bulan dilindungi garansi aktif 25–30 hari penuh (terhitung full sebulan), dan paket mingguan bergaransi 7 hari.',
            'SOP Klaim Garansi Cepat: Jika mengalami kendala login atau logout tak terduga, cukup kirim screenshot bukti kendala dan tanggal order ke admin WhatsApp.',
            'Solutif & Bebas Ribet: Admin akan segera memproses pengecekan ke supplier first-hand untuk memperbaiki akun atau mengganti dengan akun baru dalam garansi.',
            'Harga Bersahabat Mahasiswa & Pelajar: Menikmati fitur premium favorit tanpa kewajiban kartu kredit internasional dan biaya berlangganan resmi yang mahal.',
            'Ketentuan Penggunaan: Untuk paket shared/family, dilarang mengubah email/password/profil yang bukan bagian akun Anda agar akun tetap awet.',
        ];

        return view('premium/index', [
            'title'      => 'Akun & Aplikasi Premium Bergaransi — Zippy Store',
            'struktur'   => $struktur,
            'waNumber'   => $wa,
            'regulasi'   => $regulasi,
            'pengaturan' => $set,
        ]);
    }
}

