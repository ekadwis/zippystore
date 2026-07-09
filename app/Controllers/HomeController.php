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
        $data = [
            'title'      => 'Zippy Store - Solusi Digital Termudah & Termurah',
            'layanan'    => (new LayananModel())->getActive(),
            'clients'    => (new ClientModel())->getActive(),
            'statistik'  => (new StatistikModel())->getActive(),
            'pengaturan' => (new PengaturanModel())->getSettings(),
            'galeri'     => (new GaleriModel())->getFiltered(),
            'testimoni'  => (new TestimoniModel())->getActive(),
        ];

        return view('home/index', $data);
    }
}