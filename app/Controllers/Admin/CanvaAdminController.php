<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CanvaSettingModel;
use App\Models\CanvaOrderModel;

class CanvaAdminController extends BaseController
{
    protected $settingModel;
    protected $orderModel;

    public function __construct()
    {
        $this->settingModel = new CanvaSettingModel();
        $this->orderModel   = new CanvaOrderModel();
        helper(['url', 'form']);
    }

    public function index()
    {
        $settings = $this->settingModel->getSettings();
        $orders   = $this->orderModel->orderBy('id', 'DESC')->findAll(30);

        return view('admin/canva/index', [
            'title'    => 'Kelola Link & Order Canva PRO EDU',
            'settings' => $settings,
            'orders'   => $orders,
        ]);
    }

    public function saveSettings()
    {
        $link = trim($this->request->getPost('invite_link') ?? '');
        $team = trim($this->request->getPost('team_name') ?? 'AEZ Team');

        if (empty($link) || !filter_var($link, FILTER_VALIDATE_URL)) {
            return redirect()->back()->with('error', 'Link undangan Canva tidak valid.');
        }

        $this->settingModel->update(1, [
            'invite_link' => $link,
            'team_name'   => $team,
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(site_url('admin/canva'))->with('success', 'Link undangan Canva berhasil diperbarui!');
    }
}

