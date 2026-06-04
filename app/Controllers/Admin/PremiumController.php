<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PremiumProdukModel;
use App\Models\PremiumDurasiModel;

class PremiumController extends BaseController
{
    protected $produkModel;
    protected $durasiModel;

    public function __construct()
    {
        $this->produkModel = new PremiumProdukModel();
        $this->durasiModel = new PremiumDurasiModel();
        helper(['url', 'form']);
    }

    // ===== DASHBOARD / LIST =====
    public function index()
    {
        return view('admin/premium/index', [
            'title'   => 'Kelola App Premium',
            'durasis' => $this->durasiModel->getWithProduk(),
        ]);
    }

    // ===== PRODUK =====
    public function produk()
    {
        return view('admin/premium/produk', [
            'title'   => 'Kelola Produk Premium',
            'produks' => $this->produkModel->orderBy('id', 'ASC')->findAll(),
        ]);
    }

    public function produkForm($id = null)
    {
        return view('admin/premium/produk_form', [
            'title' => $id ? 'Edit Produk' : 'Tambah Produk',
            'row'   => $id ? $this->produkModel->find($id) : null,
        ]);
    }

    public function produkSave($id = null)
    {
        $nama = trim((string) $this->request->getPost('nama'));
        if ($nama === '') {
            return redirect()->back()->withInput()->with('error', 'Nama produk wajib diisi.');
        }
        $data = [
            'nama'      => $nama,
            'slug'      => url_title($this->request->getPost('slug') ?: $nama, '-', true),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'icon'      => $this->request->getPost('icon'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];
        if ($id) {
            $this->produkModel->update($id, $data);
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->produkModel->insert($data);
        }
        return redirect()->to(site_url('admin/premium/produk'))->with('success', 'Produk tersimpan.');
    }

    public function produkDelete($id)
    {
        $this->produkModel->update($id, ['is_active' => 0]);
        return redirect()->to(site_url('admin/premium/produk'))->with('success', 'Produk dinonaktifkan.');
    }

    // ===== DURASI =====
    public function durasi()
    {
        return view('admin/premium/durasi', [
            'title'   => 'Kelola Durasi & Harga',
            'durasis' => $this->durasiModel->getWithProduk(),
        ]);
    }

    public function durasiForm($id = null)
    {
        return view('admin/premium/durasi_form', [
            'title'   => $id ? 'Edit Durasi' : 'Tambah Durasi',
            'row'     => $id ? $this->durasiModel->find($id) : null,
            'produks' => $this->produkModel->getActive(),
        ]);
    }

    public function durasiSave($id = null)
    {
        $label  = trim((string) $this->request->getPost('label'));
        $hari   = (int) $this->request->getPost('durasi_hari');
        $harga  = (int) $this->request->getPost('harga');

        if ($label === '' || $hari <= 0 || $harga < 0) {
            return redirect()->back()->withInput()->with('error', 'Label, durasi (hari), dan harga wajib valid.');
        }

        $data = [
            'produk_id'   => (int) $this->request->getPost('produk_id'),
            'label'       => $label,
            'durasi_hari' => $hari,
            'harga'       => $harga,
            'is_active'   => $this->request->getPost('is_active') ? 1 : 0,
        ];
        if ($id) {
            $this->durasiModel->update($id, $data);
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->durasiModel->insert($data);
        }
        return redirect()->to(site_url('admin/premium/durasi'))->with('success', 'Durasi tersimpan.');
    }

    public function durasiDelete($id)
    {
        $this->durasiModel->update($id, ['is_active' => 0]);
        return redirect()->to(site_url('admin/premium/durasi'))->with('success', 'Durasi dinonaktifkan.');
    }
}