<?php

namespace App\Models;

use CodeIgniter\Model;

class FlashSaleModel extends Model
{
    protected $table         = 'flash_sale';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'judul',
        'subjudul',
        'badge_text',
        'end_time',
        'is_active',
        'items_json'
    ];

    /**
     * Ambil data Flash Sale aktif beserta item yang ter-decode.
     * Jika belum ada di database, kembalikan data default berkarakter.
     */
    public function getActiveFlashSale(): array
    {
        $sale = $this->where('is_active', 1)->orderBy('id', 'DESC')->first();

        $defaultItems = [
            [
                'id' => 1,
                'name' => 'Netflix 1P1U (7 Hari)',
                'category' => 'Akun Premium',
                'badge' => '⚡ Minggu Ini (18 Okt)',
                'original_price' => 14000,
                'discount_price' => 9000,
                'total_quota' => 35,
                'sold_quota' => 24,
                'whatsapp_text' => 'Halo Zippy Store, saya mau klaim Promo Minggu Ini Netflix 1P1U 7 Hari (Rp 9.000)!'
            ],
            [
                'id' => 2,
                'name' => 'Canva Pro (3 Bulan)',
                'category' => 'Akun Premium',
                'badge' => '🔥 Promo Oktober',
                'original_price' => 12000,
                'discount_price' => 5000,
                'total_quota' => 50,
                'sold_quota' => 37,
                'whatsapp_text' => 'Halo Zippy Store, saya mau klaim Promo Oktober Canva Pro 3 Bulan (Rp 5.000)!'
            ],
            [
                'id' => 3,
                'name' => 'Canva Pro (12 Bulan / 1 Tahun)',
                'category' => 'Akun Premium',
                'badge' => '🔥 Best Value 1 Thn',
                'original_price' => 35000,
                'discount_price' => 15000,
                'total_quota' => 40,
                'sold_quota' => 28,
                'whatsapp_text' => 'Halo Zippy Store, saya mau klaim Promo Oktober Canva Pro 12 Bulan (Rp 15.000)!'
            ],
            [
                'id' => 4,
                'name' => 'Gemini PRO (6 Bulan)',
                'category' => 'Akun Premium',
                'badge' => '🤖 AI Super Deal',
                'original_price' => 99000,
                'discount_price' => 50000,
                'total_quota' => 30,
                'sold_quota' => 19,
                'whatsapp_text' => 'Halo Zippy Store, saya mau klaim Promo Oktober Gemini PRO 6 Bulan (Rp 50.000)!'
            ]
        ];

        if (!$sale) {
            return [
                'id' => 0,
                'judul' => '⚡ PROMO SPESIAL MINGGU INI & BULAN OKTOBER',
                'subjudul' => 'Klaim slot harga miring Netflix 1P1U, Canva Pro, dan Gemini PRO sebelum batas promo berakhir!',
                'badge_text' => '🔥 PROMO MINGGU INI • S/D 18 OKT 23:59',
                'end_time' => '2026-10-18 23:59:00',
                'is_active' => 1,
                'items' => $defaultItems
            ];
        }

        $items = [];
        if (!empty($sale['items_json'])) {
            $decoded = json_decode($sale['items_json'], true);
            if (is_array($decoded) && count($decoded) > 0) {
                $items = $decoded;
            }
        }

        if (empty($items)) {
            $items = $defaultItems;
        }

        $sale['items'] = $items;
        return $sale;
    }
}
