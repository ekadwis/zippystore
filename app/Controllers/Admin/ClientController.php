<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ClientModel;

class ClientController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new ClientModel();
        helper(['url', 'form']);
    }

    public function index()
    {
        return view('admin/client/index', [
            'title'   => 'Kelola Client',
            'clients' => $this->model->getAll(),
        ]);
    }

    public function form($id = null)
    {
        return view('admin/client/form', [
            'title' => $id ? 'Edit Client' : 'Tambah Client',
            'row'   => $id ? $this->model->find($id) : null,
        ]);
    }

    public function save($id = null)
    {
        $nama = trim((string) $this->request->getPost('nama'));
        if ($nama === '') {
            return redirect()->back()->withInput()->with('error', 'Nama client wajib diisi.');
        }
        $data = [
            'nama'      => $nama,
            'logo'      => $this->request->getPost('logo'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];
        if ($id) {
            $this->model->update($id, $data);
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->model->insert($data);
        }
        return redirect()->to(site_url('admin/client'))->with('success', 'Client tersimpan.');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to(site_url('admin/client'))->with('success', 'Client dihapus.');
    }
}