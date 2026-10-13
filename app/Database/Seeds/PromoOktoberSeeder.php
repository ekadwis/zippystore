<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PromoOktoberSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // 1. UPDATE / INSERT KE TABEL FLASH SALE (Jumbotron Banner)
        $flashSaleData = [
            'judul'      => '⚡ PROMO SPESIAL MINGGU INI & BULAN OKTOBER',
            'subjudul'   => 'Klaim slot harga miring Netflix 1P1U, Canva Pro, dan Gemini PRO sebelum batas promo berakhir!',
            'badge_text' => '🔥 PROMO MINGGU INI • S/D 18 OKT 23:59',
            'end_time'   => '2026-10-18 23:59:00',
            'is_active'  => 1,
            'items_json' => json_encode([
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
            ], JSON_UNESCAPED_UNICODE),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $existing = $db->table('flash_sale')->get()->getFirstRow('array');
        if ($existing) {
            $db->table('flash_sale')->where('id', $existing['id'])->update($flashSaleData);
            echo "Flash Sale berhasil diupdate (ID: " . $existing['id'] . ")\n";
        } else {
            $flashSaleData['created_at'] = date('Y-m-d H:i:s');
            $db->table('flash_sale')->insert($flashSaleData);
            echo "Flash Sale berhasil dibuat baru.\n";
        }

        // 2. SINKRONISASI KE TABEL PROMO (Kupon & List Promo)
        $promos = [
            [
                'kode'        => 'NETFLIX7D',
                'diskon'      => 'Diskon Rp 5.000 (Rp 14rb -> Rp 9rb)',
                'deskripsi'   => 'Promo Minggu Ini Netflix 1P1U 7 Hari hanya Rp 9.000. Berlaku sampai 18 Oktober 2026 pukul 23:59.',
                'valid_until' => '2026-10-18',
                'is_active'   => 1
            ],
            [
                'kode'        => 'CANVA3M',
                'diskon'      => 'Diskon Rp 7.000 (Rp 12rb -> Rp 5rb)',
                'deskripsi'   => 'Promo Bulan Oktober Canva Pro 3 Bulan hanya Rp 5.000 (Hemat 58%).',
                'valid_until' => '2026-10-31',
                'is_active'   => 1
            ],
            [
                'kode'        => 'CANVA12M',
                'diskon'      => 'Diskon Rp 20.000 (Rp 35rb -> Rp 15rb)',
                'deskripsi'   => 'Promo Bulan Oktober Canva Pro 12 Bulan (1 Tahun) hanya Rp 15.000.',
                'valid_until' => '2026-10-31',
                'is_active'   => 1
            ],
            [
                'kode'        => 'GEMINIPRO6M',
                'diskon'      => 'Spesial Rp 50.000 (Hemat s/d 50%)',
                'deskripsi'   => 'Promo Bulan Oktober Gemini PRO 6 Bulan hanya Rp 50.000.',
                'valid_until' => '2026-10-31',
                'is_active'   => 1
            ]
        ];

        foreach ($promos as $p) {
            $check = $db->table('promo')->where('kode', $p['kode'])->get()->getFirstRow();
            if ($check) {
                $db->table('promo')->where('kode', $p['kode'])->update($p);
            } else {
                $db->table('promo')->insert($p);
            }
        }
        echo "Tabel Promo berhasil disinkronkan.\n";

        // 3. UPDATE / SINKRONKAN HARGA KATALOG PREMIUM (premium_produk & premium_durasi)
        // Cek / Buat Produk Canva
        $canva = $db->table('premium_produk')->where('nama', 'Canva Pro')->orWhere('slug', 'canva')->get()->getFirstRow('array');
        if (!$canva) {
            $db->table('premium_produk')->insert([
                'nama' => 'Canva Pro',
                'slug' => 'canva',
                'deskripsi' => 'Aplikasi desain grafis premium full fitur, template pro, background remover.',
                'is_active' => 1
            ]);
            $canvaId = $db->insertID();
        } else {
            $canvaId = $canva['id'];
        }

        // Cek / Buat Produk Netflix
        $netflix = $db->table('premium_produk')->where('nama', 'Netflix Premium')->orWhere('slug', 'netflix')->get()->getFirstRow('array');
        if (!$netflix) {
            $db->table('premium_produk')->insert([
                'nama' => 'Netflix Premium',
                'slug' => 'netflix',
                'deskripsi' => 'Streaming film & serial kualitas 4K UHD, anti on-hold.',
                'is_active' => 1
            ]);
            $netflixId = $db->insertID();
        } else {
            $netflixId = $netflix['id'];
        }

        // Cek / Buat Produk Gemini Pro
        $gemini = $db->table('premium_produk')->where('nama', 'Gemini PRO')->orWhere('slug', 'gemini-pro')->get()->getFirstRow('array');
        if (!$gemini) {
            $db->table('premium_produk')->insert([
                'nama' => 'Gemini PRO',
                'slug' => 'gemini-pro',
                'deskripsi' => 'Model AI cerdas Google untuk coding, riset, dan analisis data.',
                'is_active' => 1
            ]);
            $geminiId = $db->insertID();
        } else {
            $geminiId = $gemini['id'];
        }

        // Update / Insert Durasi Canva
        $db->table('premium_durasi')->replace([
            'produk_id' => $canvaId,
            'label' => '3 Bulan (Promo Okt)',
            'durasi_hari' => 90,
            'harga' => 5000,
            'is_active' => 1
        ]);
        $db->table('premium_durasi')->replace([
            'produk_id' => $canvaId,
            'label' => '12 Bulan / 1 Tahun (Promo Okt)',
            'durasi_hari' => 365,
            'harga' => 15000,
            'is_active' => 1
        ]);

        // Update / Insert Durasi Netflix 7 Hari
        $db->table('premium_durasi')->replace([
            'produk_id' => $netflixId,
            'label' => '1P1U 7 Hari (Promo Minggu Ini)',
            'durasi_hari' => 7,
            'harga' => 9000,
            'is_active' => 1
        ]);

        // Update / Insert Durasi Gemini PRO 6 Bulan
        $db->table('premium_durasi')->replace([
            'produk_id' => $geminiId,
            'label' => '6 Bulan (Promo Okt)',
            'durasi_hari' => 180,
            'harga' => 50000,
            'is_active' => 1
        ]);

        echo "Katalog Premium Durasi berhasil disinkronkan.\n";
    }
}
