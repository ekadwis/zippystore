<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PengaturanModel;

class PengaturanController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new PengaturanModel();
        helper(['url', 'form']);
    }

    public function index()
    {
        return view('admin/pengaturan/index', [
            'title' => 'Pengaturan Umum',
            'row'   => $this->model->getSettings(),
        ]);
    }

    public function save()
    {
        $data = [
            'nama_toko'    => trim((string) $this->request->getPost('nama_toko')),
            'deskripsi'    => $this->request->getPost('deskripsi'),
            'email'        => $this->request->getPost('email'),
            'no_wa'        => $this->request->getPost('no_wa'),
            'ig_link'      => $this->request->getPost('ig_link'),
            'tele_link'    => $this->request->getPost('tele_link'),
            'twitter_link' => $this->request->getPost('twitter_link'),
            'alamat'       => $this->request->getPost('alamat'),
            'logo'         => $this->request->getPost('logo'),
            'favicon'      => $this->request->getPost('favicon'),
        ];

        if ($data['nama_toko'] === '') {
            return redirect()->back()->withInput()->with('error', 'Nama toko wajib diisi.');
        }

        $this->model->saveSettings($data);
        return redirect()->to(site_url('admin/pengaturan'))->with('success', 'Pengaturan tersimpan.');
    }
}