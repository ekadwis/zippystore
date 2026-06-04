<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GaleriModel;

class GaleriController extends BaseController
{
    protected $model;

    // Daftar kategori valid (sinkron dengan filter publik)
    protected $kategoriList = ['surat', 'tugas', 'premium', 'sosmed'];

    public function __construct()
    {
        $this->model = new GaleriModel();
        helper(['url', 'form']);
    }

    public function index()
    {
        return view('admin/galeri/index', [
            'title'   => 'Kelola Galeri',
            'galeris' => $this->model->getAll(),
        ]);
    }

    public function form($id = null)
    {
        return view('admin/galeri/form', [
            'title'        => $id ? 'Edit Gambar' : 'Tambah Gambar',
            'row'          => $id ? $this->model->find($id) : null,
            'kategoriList' => $this->kategoriList,
        ]);
    }

    public function save($id = null)
    {
        $nama     = trim((string) $this->request->getPost('nama'));
        $file     = trim((string) $this->request->getPost('file'));
        $kategori = $this->request->getPost('kategori');

        if ($nama === '' || $file === '') {
            return redirect()->back()->withInput()->with('error', 'Nama dan URL gambar wajib diisi.');
        }
        if (! filter_var($file, FILTER_VALIDATE_URL)) {
            return redirect()->back()->withInput()->with('error', 'URL gambar tidak valid. Tempel URL lengkap (http/https).');
        }
        if (! in_array($kategori, $this->kategoriList, true)) {
            return redirect()->back()->withInput()->with('error', 'Kategori tidak valid.');
        }

        $data = [
            'nama'      => $nama,
            'file'      => $file,
            'kategori'  => $kategori,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if ($id) {
            $this->model->update($id, $data);
            $msg = 'Gambar diperbarui.';
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->model->insert($data);
            $msg = 'Gambar ditambahkan.';
        }

        return redirect()->to(site_url('admin/galeri'))->with('success', $msg);
    }

    public function toggle($id)
    {
        $row = $this->model->find($id);
        if ($row) {
            $this->model->update($id, ['is_active' => $row['is_active'] ? 0 : 1]);
        }
        return redirect()->to(site_url('admin/galeri'))->with('success', 'Status gambar diubah.');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to(site_url('admin/galeri'))->with('success', 'Gambar dihapus.');
    }
}