<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TestimoniModel;

class TestimoniController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new TestimoniModel();
        helper(['url', 'form']);
    }

    public function index()
    {
        return view('admin/testimoni/index', [
            'title'      => 'Kelola Testimoni',
            'testimonis' => $this->model->getAll(),
        ]);
    }

    public function form($id = null)
    {
        return view('admin/testimoni/form', [
            'title' => $id ? 'Edit Testimoni' : 'Tambah Testimoni',
            'row'   => $id ? $this->model->find($id) : null,
        ]);
    }

    public function save($id = null)
    {
        $nama   = trim((string) $this->request->getPost('nama'));
        $gambar = trim((string) $this->request->getPost('gambar'));
        $isi    = trim((string) $this->request->getPost('isi'));
        $tanggal = $this->request->getPost('tanggal');

        // Validasi sederhana
        if ($nama === '' || $gambar === '') {
            return redirect()->back()->withInput()->with('error', 'Nama dan URL gambar wajib diisi.');
        }

        // Pastikan gambar berupa URL (sesuai keputusan: foto online)
        if (! filter_var($gambar, FILTER_VALIDATE_URL)) {
            return redirect()->back()->withInput()->with('error', 'URL gambar tidak valid. Tempel URL lengkap (diawali http/https).');
        }

        $data = [
            'nama'      => $nama,
            'isi'       => $isi !== '' ? $isi : null,
            'gambar'    => $gambar,
            'tanggal'   => $tanggal ?: date('Y-m-d H:i:s'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if ($id) {
            $this->model->update($id, $data);
            $msg = 'Testimoni diperbarui.';
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->model->insert($data);
            $msg = 'Testimoni ditambahkan.';
        }

        return redirect()->to(site_url('admin/testimoni'))->with('success', $msg);
    }

    public function toggle($id)
    {
        $row = $this->model->find($id);
        if ($row) {
            $this->model->update($id, ['is_active' => $row['is_active'] ? 0 : 1]);
        }
        return redirect()->to(site_url('admin/testimoni'))->with('success', 'Status testimoni diubah.');
    }

    public function delete($id)
    {
        $this->model->delete($id); // hapus permanen
        return redirect()->to(site_url('admin/testimoni'))->with('success', 'Testimoni dihapus.');
    }
}