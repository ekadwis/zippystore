<?php

namespace App\Controllers;

use App\Models\TestimoniModel;
use App\Models\PengaturanModel;

class TestimoniController extends BaseController
{
    public function index()
    {
        $testimoni = (new TestimoniModel())->getActive();

        $data = [
            'title'        => 'Kata Mereka - Testimoni Zippy Store',
            'testimoni'    => array_slice($testimoni, 0, 18),
            'totalTesti'   => count($testimoni),
            'telegramLink' => 'https://t.me/klddies',
            'pengaturan'   => (new PengaturanModel())->getSettings(),
        ];

        return view('testimonials/index', $data);
    }
}