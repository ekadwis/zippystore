<?php

namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\PengaturanModel;

class AboutController extends BaseController
{
    public function index()
    {
        $data = [
            'title'      => 'Tentang Zippy Store',
            'layanan'    => (new LayananModel())->getActive(),
            'pengaturan' => (new PengaturanModel())->getSettings(),
        ];

        return view('about/index', $data);
    }
}