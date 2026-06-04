<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OtpProdukModel;

class OtpController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new OtpProdukModel();
        helper(['url', 'form']);
    }

    public function index()
    {
        return view('admin/otp/index', [
            'title'   => 'Kelola Nomor OTP',
            'produks' => $this->model->getAll(),
        ]);
    }

    public function form($id = null)
    {
        return view('admin/otp/form', [
            'title' => $id ? 'Edit Produk OTP' : 'Tambah Produk OTP',
            'row'   => $id ? $this->model->find($id) : null,
        ]);
    }

    public function save($id = null)
    {
        $nama  = trim((string) $this->request->getPost('nama'));
        $harga = (int) $this->request->getPost('harga');

        if ($nama === '' || $harga < 0) {
            return redirect()->back()->withInput()->with('error', 'Nama wajib diisi dan harga tidak boleh negatif.');
        }

        $data = [
            'nama'      => $nama,
            'harga'     => $harga,
            'icon'      => $this->request->getPost('icon'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if ($id) {
            $this->model->update($id, $data);
            $msg = 'Produk OTP diperbarui.';
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->model->insert($data);
            $msg = 'Produk OTP ditambahkan.';
        }
        return redirect()->to(site_url('admin/otp'))->with('success', $msg);
    }

    public function toggle($id)
    {
        $row = $this->model->find($id);
        if ($row) {
            $this->model->update($id, ['is_active' => $row['is_active'] ? 0 : 1]);
        }
        return redirect()->to(site_url('admin/otp'))->with('success', 'Status produk diubah.');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to(site_url('admin/otp'))->with('success', 'Produk OTP dihapus.');
    }
}