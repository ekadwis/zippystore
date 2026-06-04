<?php

namespace App\Controllers;

use App\Models\GaleriModel;
use App\Models\PengaturanModel;

class GalleryController extends BaseController
{
    public function index()
    {
        $kategori = $this->request->getGet('kategori');
        $keyword  = $this->request->getGet('q');

        $data = [
            'title'      => 'Gallery - Zippy Store',
            'galeri'     => (new GaleriModel())->getFiltered($kategori, $keyword),
            'kategori'   => $kategori ?: 'semua',
            'keyword'    => $keyword,
            'pengaturan' => (new PengaturanModel())->getSettings(),
        ];

        return view('gallery/index', $data);
    }
}