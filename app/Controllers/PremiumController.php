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

        return view('premium/index', [
            'title'      => 'App Premium - Zippy Store',
            'struktur'   => $struktur,
            'waNumber'   => $wa,
            'pengaturan' => $set,
        ]);
    }
}