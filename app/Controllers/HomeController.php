<?php

namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\PromoModel;
use App\Models\ClientModel;
use App\Models\PengaturanModel;

class HomeController extends BaseController
{
    public function index()
    {
        $layananModel = new LayananModel();
        $clientModel  = new ClientModel();

        $data = [
            'title'      => 'Zippy Store - Solusi Digital Termudah & Termurah',
            'layanan'    => $layananModel->getActive(),
            'clients'    => $clientModel->getActive(),
            'pengaturan' => (new PengaturanModel())->getSettings(),
        ];

        return view('home/index', $data);
    }
}