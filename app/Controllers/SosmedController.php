<?php

namespace App\Controllers;

use App\Models\SosmedPlatformModel;
use App\Models\SosmedLayananModel;
use App\Models\SosmedPaketModel;
use App\Models\PengaturanModel;

class SosmedController extends BaseController
{
    protected $platformModel;
    protected $layananModel;
    protected $paketModel;

    public function __construct()
    {
        $this->platformModel = new SosmedPlatformModel();
        $this->layananModel  = new SosmedLayananModel();
        $this->paketModel    = new SosmedPaketModel();
        helper(['sosmed', 'url']);
    }

    public function index()
    {
        // Susun data: platform -> layanan -> paket (hanya yang aktif)
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

        // Data layanan untuk kalkulator (flat, untuk JS dropdown)
        $layananFlat = $this->layananModel->getWithPlatform(true);

        return view('sosmed/index', [
            'title'       => 'Sosmed Boost - Zippy Store',
            'struktur'    => $struktur,
            'layananFlat' => $layananFlat,
            'pengaturan'  => (new PengaturanModel())->getSettings(),
        ]);
    }

    // Endpoint AJAX hitung harga custom (publik)
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

        $pakets = $this->paketModel->getByLayanan($layananId);
        if (empty($pakets)) {
            return $this->response->setJSON(['ok' => false, 'msg' => 'Belum ada paket untuk layanan ini.']);
        }

        $hasil = hitung_harga_sosmed($pakets, $jumlah);

        return $this->response->setJSON([
            'ok'        => true,
            'harga'     => $hasil['harga'],
            'harga_fmt' => 'Rp ' . number_format($hasil['harga'], 0, ',', '.'),
            'jumlah'    => $jumlah,
            'layanan'   => $layanan['nama'],
        ]);
    }
}