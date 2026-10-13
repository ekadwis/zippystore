<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FlashSaleModel;

class FlashSaleController extends BaseController
{
    protected $flashSaleModel;

    public function __construct()
    {
        $this->flashSaleModel = new FlashSaleModel();
    }

    public function index()
    {
        $flashSale = $this->flashSaleModel->getActiveFlashSale();

        $data = [
            'title'     => '⚡ Kelola Flash Sale Banner (Chunky Pop)',
            'flashSale' => $flashSale,
        ];

        return view('admin/flash_sale/index', $data);
    }

    public function save()
    {
        $id = $this->request->getPost('id');
        $judul = trim($this->request->getPost('judul') ?? '');
        $subjudul = trim($this->request->getPost('subjudul') ?? '');
        $badgeText = trim($this->request->getPost('badge_text') ?? '');
        $endTime = trim($this->request->getPost('end_time') ?? '');
        $isActive = $this->request->getPost('is_active') ? 1 : 0;

        // Process item list
        $itemNames = $this->request->getPost('item_name') ?? [];
        $itemCategories = $this->request->getPost('item_category') ?? [];
        $itemBadges = $this->request->getPost('item_badge') ?? [];
        $itemOrigPrices = $this->request->getPost('item_original_price') ?? [];
        $itemDiscPrices = $this->request->getPost('item_discount_price') ?? [];
        $itemTotalQuotas = $this->request->getPost('item_total_quota') ?? [];
        $itemSoldQuotas = $this->request->getPost('item_sold_quota') ?? [];
        $itemWaTexts = $this->request->getPost('item_whatsapp_text') ?? [];

        $items = [];
        foreach ($itemNames as $i => $name) {
            if (empty(trim($name))) continue;

            $items[] = [
                'id' => $i + 1,
                'name' => trim($name),
                'category' => trim($itemCategories[$i] ?? 'Digital'),
                'badge' => trim($itemBadges[$i] ?? ''),
                'original_price' => (int)($itemOrigPrices[$i] ?? 0),
                'discount_price' => (int)($itemDiscPrices[$i] ?? 0),
                'total_quota' => (int)($itemTotalQuotas[$i] ?? 20),
                'sold_quota' => (int)($itemSoldQuotas[$i] ?? 0),
                'whatsapp_text' => trim($itemWaTexts[$i] ?? "Halo Zippy Store, saya mau klaim Flash Sale " . trim($name))
            ];
        }

        $payload = [
            'judul'      => $judul ?: '⚡ KILAT ZIPPY: FLASH SALE AKHIR PEKAN',
            'subjudul'   => $subjudul ?: 'Ambil kuota promo sebelum hitung mundur habis!',
            'badge_text' => $badgeText ?: '⚡ FLASH SALE TERBATAS',
            'end_time'   => $endTime ?: date('Y-m-d H:i:s', strtotime('+8 hours')),
            'is_active'  => $isActive,
            'items_json' => json_encode($items, JSON_UNESCAPED_UNICODE)
        ];

        if (!empty($id) && is_numeric($id) && (int)$id > 0) {
            $this->flashSaleModel->update($id, $payload);
        } else {
            // Cek apakah ada record yang bisa diupdate
            $existing = $this->flashSaleModel->first();
            if ($existing) {
                $this->flashSaleModel->update($existing['id'], $payload);
            } else {
                $this->flashSaleModel->insert($payload);
            }
        }

        return redirect()->to(site_url('admin/flash-sale'))->with('success', 'Banner Flash Sale berhasil diperbarui!');
    }
}
