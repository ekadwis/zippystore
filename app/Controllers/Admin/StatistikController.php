<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\StatistikModel;

class StatistikController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new StatistikModel();
        helper(['url', 'form']);
    }

    public function index()
    {
        return view('admin/statistik/index', [
            'title'     => 'Kelola Statistik',
            'statistik' => $this->model->getAll(),
        ]);
    }

    public function form($id = null)
    {
        return view('admin/statistik/form', [
            'title' => $id ? 'Edit Statistik' : 'Tambah Statistik',
            'row'   => $id ? $this->model->find($id) : null,
        ]);
    }

    public function save($id = null)
    {
        $angka = trim((string) $this->request->getPost('angka'));
        $label = trim((string) $this->request->getPost('label'));

        if ($angka === '' || $label === '') {
            return redirect()->back()->withInput()->with('error', 'Angka dan label wajib diisi.');
        }

        $data = [
            'icon'      => $this->request->getPost('icon'),
            'angka'     => $angka,
            'label'     => $label,
            'urutan'    => (int) $this->request->getPost('urutan'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if ($id) {
            $this->model->update($id, $data);
        } else {
            $this->model->insert($data);
        }
        return redirect()->to(site_url('admin/statistik'))->with('success', 'Statistik tersimpan.');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to(site_url('admin/statistik'))->with('success', 'Statistik dihapus.');
    }
}