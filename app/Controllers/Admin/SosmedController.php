<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SosmedPlatformModel;
use App\Models\SosmedLayananModel;
use App\Models\SosmedPaketModel;

class SosmedController extends BaseController
{
    protected $platformModel;
    protected $layananModel;
    protected $paketModel;

    public function __construct()
    {
        $this->platformModel = new SosmedPlatformModel();
        $this->layananModel  = new SosmedLayananModel();
        $this->paketModel    = new SosmedPaketModel();
        helper(['sosmed', 'url', 'form']);
    }

    // ===== DASHBOARD / LIST PAKET =====
    public function index()
    {
        return view('admin/sosmed/index', [
            'title'  => 'Dashboard Sosmed Boost',
            'pakets' => $this->paketModel->getWithInfo(),
        ]);
    }

    // ============ PLATFORM ============
    public function platform()
    {
        return view('admin/sosmed/platform', [
            'title'     => 'Kelola Platform',
            'platforms' => $this->platformModel->orderBy('id', 'ASC')->findAll(),
        ]);
    }

    public function platformForm($id = null)
    {
        return view('admin/sosmed/platform_form', [
            'title' => $id ? 'Edit Platform' : 'Tambah Platform',
            'row'   => $id ? $this->platformModel->find($id) : null,
        ]);
    }

    public function platformSave($id = null)
    {
        $data = [
            'nama'      => $this->request->getPost('nama'),
            'slug'      => url_title($this->request->getPost('slug') ?: $this->request->getPost('nama'), '-', true),
            'icon'      => $this->request->getPost('icon'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];
        if ($id) {
            $this->platformModel->update($id, $data);
        } else {
            $this->platformModel->insert($data);
        }
        return redirect()->to(site_url('admin/sosmed/platform'))->with('success', 'Platform tersimpan.');
    }

    public function platformDelete($id)
    {
        // soft delete
        $this->platformModel->update($id, ['is_active' => 0]);
        return redirect()->to(site_url('admin/sosmed/platform'))->with('success', 'Platform dinonaktifkan.');
    }

    // ============ LAYANAN ============
    public function layanan()
    {
        return view('admin/sosmed/layanan', [
            'title'    => 'Kelola Layanan',
            'layanans' => $this->layananModel->getWithPlatform(),
        ]);
    }

    public function layananForm($id = null)
    {
        return view('admin/sosmed/layanan_form', [
            'title'     => $id ? 'Edit Layanan' : 'Tambah Layanan',
            'row'       => $id ? $this->layananModel->find($id) : null,
            'platforms' => $this->platformModel->getActive(),
        ]);
    }

    public function layananSave($id = null)
    {
        $min = (int) $this->request->getPost('min_order');
        $max = (int) $this->request->getPost('max_order');

        // validasi min/max
        if ($max < $min) {
            return redirect()->back()->withInput()->with('error', 'max_order harus >= min_order.');
        }

        $data = [
            'platform_id' => (int) $this->request->getPost('platform_id'),
            'nama'        => $this->request->getPost('nama'),
            'slug'        => url_title($this->request->getPost('slug') ?: $this->request->getPost('nama'), '-', true),
            'min_order'   => $min,
            'max_order'   => $max,
            'is_active'   => $this->request->getPost('is_active') ? 1 : 0,
        ];
        if ($id) {
            $this->layananModel->update($id, $data);
        } else {
            $this->layananModel->insert($data);
        }
        return redirect()->to(site_url('admin/sosmed/layanan'))->with('success', 'Layanan tersimpan.');
    }

    public function layananDelete($id)
    {
        $this->layananModel->update($id, ['is_active' => 0]);
        return redirect()->to(site_url('admin/sosmed/layanan'))->with('success', 'Layanan dinonaktifkan.');
    }

    // ============ PAKET ============
    public function paket()
    {
        return view('admin/sosmed/paket', [
            'title'  => 'Kelola Paket',
            'pakets' => $this->paketModel->getWithInfo(),
        ]);
    }

    public function paketForm($id = null)
    {
        return view('admin/sosmed/paket_form', [
            'title'    => $id ? 'Edit Paket' : 'Tambah Paket',
            'row'      => $id ? $this->paketModel->find($id) : null,
            'layanans' => $this->layananModel->getWithPlatform(true),
        ]);
    }

    public function paketSave($id = null)
    {
        $jumlah = (int) $this->request->getPost('jumlah');
        $harga  = (int) $this->request->getPost('harga');

        if ($jumlah <= 0 || $harga < 0) {
            return redirect()->back()->withInput()->with('error', 'Jumlah harus > 0 dan harga tidak boleh negatif.');
        }

        $data = [
            'layanan_id' => (int) $this->request->getPost('layanan_id'),
            'jumlah'     => $jumlah,
            'harga'      => $harga,
            'is_active'  => $this->request->getPost('is_active') ? 1 : 0,
        ];
        if ($id) {
            $this->paketModel->update($id, $data);
        } else {
            $this->paketModel->insert($data);
        }
        return redirect()->to(site_url('admin/sosmed/paket'))->with('success', 'Paket tersimpan.');
    }

    public function paketDelete($id)
    {
        $this->paketModel->update($id, ['is_active' => 0]);
        return redirect()->to(site_url('admin/sosmed/paket'))->with('success', 'Paket dinonaktifkan.');
    }

    // ============ KALKULATOR ============
    public function kalkulator()
    {
        return view('admin/sosmed/kalkulator', [
            'title'     => 'Kalkulator Harga Custom',
            'platforms' => $this->platformModel->getActive(),
            'layanans'  => $this->layananModel->getWithPlatform(true),
        ]);
    }

    public function kalkulatorHitung()
    {
        $layananId = (int) $this->request->getPost('layanan_id');
        $jumlah    = (int) $this->request->getPost('jumlah');

        $layanan = $this->layananModel->find($layananId);
        if (! $layanan) {
            return $this->response->setJSON(['ok' => false, 'msg' => 'Layanan tidak ditemukan.']);
        }

        // validasi min/max
        if ($jumlah < (int) $layanan['min_order'] || $jumlah > (int) $layanan['max_order']) {
            return $this->response->setJSON([
                'ok'  => false,
                'msg' => "Jumlah harus antara {$layanan['min_order']} - {$layanan['max_order']}.",
            ]);
        }

        $pakets = $this->paketModel->getByLayanan($layananId);
        if (empty($pakets)) {
            return $this->response->setJSON(['ok' => false, 'msg' => 'Belum ada paket untuk layanan ini.']);
        }

        $hasil = hitung_harga_sosmed($pakets, $jumlah);

        return $this->response->setJSON([
            'ok'        => true,
            'harga'     => $hasil['harga'],
            'harga_fmt' => 'Rp ' . number_format($hasil['harga'], 0, ',', '.'),
            'tier'      => $hasil['tier'],
            'unit'      => $hasil['unit'],
            'ref'       => $hasil['ref'] ? [
                'jumlah' => (int) $hasil['ref']['jumlah'],
                'harga'  => 'Rp ' . number_format((int) $hasil['ref']['harga'], 0, ',', '.'),
            ] : null,
        ]);
    }
}