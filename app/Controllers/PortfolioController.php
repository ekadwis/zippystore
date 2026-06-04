<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\PengaturanModel;

class PortfolioController extends BaseController
{
    public function index()
    {
        $data = [
            'title'      => 'Portfolio - Zippy Store',
            'clients'    => (new ClientModel())->getActive(),
            'pengaturan' => (new PengaturanModel())->getSettings(),
        ];

        return view('portfolio/index', $data);
    }
}