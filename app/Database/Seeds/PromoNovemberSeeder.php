<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PromoNovemberSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // 1. UPDATE FLASH SALE (Jumbotron Banner)
        $flashSaleData = [
            'judul'      => '🇮🇩 PROMO SPESIAL HARI PAHLAWAN (NOVEMBER 2026)',
            'subjudul'   => 'Klaim slot harga spesial Hari Pahlawan untuk Netflix 1P1U, Canva Pro Edu, dan Gemini PRO sebelum batas promo berakhir!',
            'badge_text' => '🔥 SPESIAL HARI PAHLAWAN • S/D 15 NOV 2026',
            'end_time'   => '2026-11-15 23:59:00',
            'is_active'  => 1,
            'items_json' => json_encode([
                [
                    'id'             => 1,
                    'name'           => 'Netflix 1P1U (7 Hari)',
                    'category'       => 'Akun Premium',
                    'badge'          => '🔥 Spesial Pahlawan',
                    'original_price' => 14000,
                    'discount_price' => 10000,
                    'total_quota'    => 13,
                    'sold_quota'     => 7,
                    'whatsapp_text'  => 'Halo Zippy Store, saya mau klaim Promo Pahlawan Netflix 1P1U 7 Hari (Rp 10.000)!'
                ],
                [
                    'id'             => 2,
                    'name'           => 'Canva Pro Edu (12 Bulan / 1 Tahun)',
                    'category'       => 'Akun Premium',
                    'badge'          => '⚡ Super Deal 12 Bulan',
                    'original_price' => 35000,
                    'discount_price' => 8000,
                    'total_quota'    => 90,
                    'sold_quota'     => 40,
                    'whatsapp_text'  => 'Halo Zippy Store, saya mau klaim Promo Pahlawan Canva Pro Edu 12 Bulan (Rp 8.000)!'
                ],
                [
                    'id'             => 3,
                    'name'           => 'Gemini PRO (6 Bulan)',
                    'category'       => 'Akun Premium',
                    'badge'          => '🤖 AI Best Deal',
                    'original_price' => 99000,
                    'discount_price' => 50000,
                    'total_quota'    => 10,
                    'sold_quota'     => 7,
                    'whatsapp_text'  => 'Halo Zippy Store, saya mau klaim Promo Pahlawan Gemini PRO 6 Bulan (Rp 50.000)!'
                ]
            ], JSON_UNESCAPED_UNICODE),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $existing = $db->table('flash_sale')->get()->getFirstRow('array');
        if ($existing) {
            $db->table('flash_sale')->where('id', $existing['id'])->update($flashSaleData);
            echo "Flash Sale Promo Hari Pahlawan berhasil diupdate (ID: " . $existing['id'] . ")\n";
        } else {
            $flashSaleData['created_at'] = date('Y-m-d H:i:s');
            $db->table('flash_sale')->insert($flashSaleData);
            echo "Flash Sale Promo Hari Pahlawan berhasil dibuat baru.\n";
        }

        // 2. SINKRONISASI KE TABEL PROMO
        $promos = [
            [
                'kode'        => 'PAHLAWAN-NFLX',
                'diskon'      => 'Diskon Rp 4.000 (Rp 14rb -> Rp 10rb)',
                'deskripsi'   => 'Promo Hari Pahlawan Netflix 1P1U 7 Hari hanya Rp 10.000. Berlaku s/d 15 November 2026.',
                'valid_until' => '2026-11-15',
                'is_active'   => 1
            ],
            [
                'kode'        => 'PAHLAWAN-CANVA',
                'diskon'      => 'Diskon Rp 27.000 (Rp 35rb -> Rp 8rb)',
                'deskripsi'   => 'Promo Hari Pahlawan Canva Pro Edu 12 Bulan hanya Rp 8.000. Berlaku s/d 15 November 2026.',
                'valid_until' => '2026-11-15',
                'is_active'   => 1
            ],
            [
                'kode'        => 'PAHLAWAN-GEMINI',
                'diskon'      => 'Diskon Rp 49.000 (Rp 99rb -> Rp 50rb)',
                'deskripsi'   => 'Promo Hari Pahlawan Gemini PRO 6 Bulan hanya Rp 50.000. Berlaku s/d 15 November 2026.',
                'valid_until' => '2026-11-15',
                'is_active'   => 1
            ]
        ];

        $db->table('promo')->emptyTable();
        $db->table('promo')->insertBatch($promos);
        echo "Tabel Promo berhasil disinkronkan.\n";
    }
}
