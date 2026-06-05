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
            'Biasakan membaca. Aturan dibuat untuk dipatuhi, bukan pajangan — pelanggaran akan ada konsekuensinya.',
            'Akun adalah produk black market: jangan harap sestabil langganan resmi. Kamu membayar jauh di bawah harga premium, jadi maklumi keterbatasannya.',
            'Perbaikan akun 0-3 hari, untuk masalah berat (massive report) 0-7 hari tergantung tingkat kesulitan. Mohon ditunggu dengan sabar.',
            'Hargai privasi penjual. Admin tidak online 24 jam, balasan tidak selalu instan.',
            'No rude buyers — mari jaga hubungan baik dengan sopan.',
            'Tidak menerima rush order. Semua akun dibuat by order (proses 10 menit s/d 1 hari) kecuali tertera ready/onhand. Tidak ada refund dalam bentuk apa pun.',
        ];

        return view('premium/index', [
            'title'      => 'App Premium - Zippy Store',
            'struktur'   => $struktur,
            'waNumber'   => $wa,
            'regulasi'   => $regulasi,   // <-- tambahkan ini
            'pengaturan' => $set,
        ]);
    }
}
