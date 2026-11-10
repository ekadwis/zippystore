<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SosmedPlatformModel;
use App\Models\SosmedLayananModel;
use App\Models\SosmedPaketModel;
use App\Models\SosmedOrderModel;
use App\Libraries\SprintpediaService;

class SosmedController extends BaseController
{
    protected $platformModel;
    protected $layananModel;
    protected $paketModel;
    protected $orderModel;

    public function __construct()
    {
        $this->platformModel = new SosmedPlatformModel();
        $this->layananModel  = new SosmedLayananModel();
        $this->paketModel    = new SosmedPaketModel();
        $this->orderModel    = new SosmedOrderModel();
        helper(['sosmed', 'url', 'form']);
    }

    // ===== DASHBOARD / LIST PAKET =====
    public function index()
    {
        // Cek Saldo Sprintpedia
        $sprintpedia = new SprintpediaService();
        $balRes = $sprintpedia->getBalance();
        $balance = $balRes['data']['balance'] ?? null;

        $paketsWithInfo = $this->paketModel
            ->select('sosmed_paket.*, sosmed_layanan.nama AS layanan_nama, sosmed_layanan.provider_service_id, sosmed_platform.nama AS platform_nama')
            ->join('sosmed_layanan', 'sosmed_layanan.id = sosmed_paket.layanan_id')
            ->join('sosmed_platform', 'sosmed_platform.id = sosmed_layanan.platform_id')
            ->orderBy('sosmed_platform.id', 'ASC')
            ->orderBy('sosmed_layanan.id', 'ASC')
            ->orderBy('sosmed_paket.jumlah', 'ASC')
            ->findAll();

        $recentOrders = $this->orderModel->orderBy('id', 'DESC')->findAll(30);

        return view('admin/sosmed/index', [
            'title'               => 'Dashboard Sosmed Boost',
            'pakets'              => $paketsWithInfo,
            'orders'              => $recentOrders,
            'totalOrdersCount'    => $this->orderModel->countAll(),
            'sprintpediaBalance'  => $balance,
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
        $nama = $this->request->getPost('nama');
        $slug = url_title($nama, '-', true);

        $data = [
            'nama'      => $nama,
            'slug'      => $slug,
            'icon'      => $this->request->getPost('icon') ?? '',
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if ($id) {
            $this->platformModel->update($id, $data);
            return redirect()->to(base_url('admin/sosmed/platform'))->with('msg', 'Platform berhasil diupdate');
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->platformModel->insert($data);
            return redirect()->to(base_url('admin/sosmed/platform'))->with('msg', 'Platform berhasil ditambahkan');
        }
    }

    public function platformDelete($id)
    {
        $this->platformModel->delete($id);
        return redirect()->to(base_url('admin/sosmed/platform'))->with('msg', 'Platform berhasil dihapus');
    }

    // ============ LAYANAN ============
    public function layanan()
    {
        return view('admin/sosmed/layanan', [
            'title'    => 'Kelola Layanan Sosmed',
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
        $nama = $this->request->getPost('nama');
        $slug = url_title($nama, '-', true);

        $data = [
            'platform_id'             => $this->request->getPost('platform_id'),
            'nama'                    => $nama,
            'slug'                    => $slug,
            'provider_service_id'     => $this->request->getPost('provider_service_id'),
            'provider_service_id_alt' => $this->request->getPost('provider_service_id_alt'),
            'min_order'               => (int)$this->request->getPost('min_order'),
            'max_order'               => (int)$this->request->getPost('max_order'),
            'is_active'               => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if ($id) {
            $this->layananModel->update($id, $data);
            return redirect()->to(base_url('admin/sosmed/layanan'))->with('msg', 'Layanan berhasil diupdate');
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->layananModel->insert($data);
            return redirect()->to(base_url('admin/sosmed/layanan'))->with('msg', 'Layanan berhasil ditambahkan');
        }
    }

    public function layananDelete($id)
    {
        $this->layananModel->delete($id);
        return redirect()->to(base_url('admin/sosmed/layanan'))->with('msg', 'Layanan berhasil dihapus');
    }

    // ============ PAKET ============
    public function paket()
    {
        return view('admin/sosmed/paket', [
            'title'  => 'Kelola Paket Sosmed',
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
        $data = [
            'layanan_id' => $this->request->getPost('layanan_id'),
            'jumlah'     => (int)$this->request->getPost('jumlah'),
            'harga'      => (float)$this->request->getPost('harga'),
            'is_active'  => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if ($id) {
            $this->paketModel->update($id, $data);
            return redirect()->to(base_url('admin/sosmed/paket'))->with('msg', 'Paket berhasil diupdate');
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->paketModel->insert($data);
            return redirect()->to(base_url('admin/sosmed/paket'))->with('msg', 'Paket berhasil ditambahkan');
        }
    }

    public function paketDelete($id)
    {
        $this->paketModel->delete($id);
        return redirect()->to(base_url('admin/sosmed/paket'))->with('msg', 'Paket berhasil dihapus');
    }

    // ============ KALKULATOR ============
    public function kalkulator()
    {
        return view('admin/sosmed/kalkulator', [
            'title'    => 'Kalkulator Harga Sosmed',
            'layanans' => $this->layananModel->getWithPlatform(true),
        ]);
    }
}
