<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PromoModel;

class PromoController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new PromoModel();
        helper(['url', 'form']);
    }

    public function index()
    {
        return view('admin/promo/index', [
            'title'  => 'Kelola Promo',
            'promos' => $this->model->getAll(),
        ]);
    }

    public function form($id = null)
    {
        return view('admin/promo/form', [
            'title' => $id ? 'Edit Promo' : 'Tambah Promo',
            'row'   => $id ? $this->model->find($id) : null,
        ]);
    }

    public function save($id = null)
    {
        $kode   = trim((string) $this->request->getPost('kode'));
        $diskon = (int) $this->request->getPost('diskon');

        if ($kode === '' || $diskon < 0 || $diskon > 100) {
            return redirect()->back()->withInput()->with('error', 'Kode wajib diisi & diskon harus 0-100.');
        }

        $data = [
            'kode'        => strtoupper($kode),
            'diskon'      => $diskon,
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'valid_until' => $this->request->getPost('valid_until') ?: null,
            'is_active'   => $this->request->getPost('is_active') ? 1 : 0,
        ];
        if ($id) {
            $this->model->update($id, $data);
        } else {
            $this->model->insert($data);
        }
        return redirect()->to(site_url('admin/promo'))->with('success', 'Promo tersimpan.');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to(site_url('admin/promo'))->with('success', 'Promo dihapus.');
    }
}