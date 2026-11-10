<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SosmedUpdateSeeder extends Seeder
{
    public function run()
    {
        $db = $this->db;

        // Matikan foreign key checks sementara untuk reset data
        $db->query('SET FOREIGN_KEY_CHECKS = 0');
        $db->table('sosmed_paket')->truncate();
        $db->table('sosmed_layanan')->truncate();
        $db->table('sosmed_platform')->truncate();
        $db->query('SET FOREIGN_KEY_CHECKS = 1');

        // 1. Insert Platforms (1: TikTok, 2: Instagram)
        $platforms = [
            ['id' => 1, 'nama' => 'TikTok', 'slug' => 'tiktok', 'icon' => 'fab fa-tiktok', 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['id' => 2, 'nama' => 'Instagram', 'slug' => 'instagram', 'icon' => 'fab fa-instagram', 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
        ];
        $db->table('sosmed_platform')->insertBatch($platforms);

        // 2. Insert Layanan
        $layanans = [
            // Instagram
            [
                'id' => 1,
                'platform_id' => 2, // IG
                'nama' => 'Followers Instagram',
                'slug' => 'followers-instagram',
                'provider_service_id' => '4320',
                'provider_service_id_alt' => '2253',
                'min_order' => 100,
                'max_order' => 50000,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'platform_id' => 2, // IG
                'nama' => 'Likes Instagram',
                'slug' => 'likes-instagram',
                'provider_service_id' => '4524',
                'provider_service_id_alt' => null,
                'min_order' => 100,
                'max_order' => 100000,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'platform_id' => 2, // IG
                'nama' => 'Views Instagram',
                'slug' => 'views-instagram',
                'provider_service_id' => '3989',
                'provider_service_id_alt' => null,
                'min_order' => 1000,
                'max_order' => 1000000,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],

            // TikTok
            [
                'id' => 4,
                'platform_id' => 1, // TikTok
                'nama' => 'Views TikTok',
                'slug' => 'views-tiktok',
                'provider_service_id' => '1181',
                'provider_service_id_alt' => null,
                'min_order' => 1000,
                'max_order' => 1000000,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 5,
                'platform_id' => 1, // TikTok
                'nama' => 'Followers TikTok LQ (Low Quality)',
                'slug' => 'followers-tiktok-lq',
                'provider_service_id' => '3941',
                'provider_service_id_alt' => null,
                'min_order' => 100,
                'max_order' => 50000,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 6,
                'platform_id' => 1, // TikTok
                'nama' => 'Followers TikTok HQ (High Quality)',
                'slug' => 'followers-tiktok-hq',
                'provider_service_id' => '4736',
                'provider_service_id_alt' => null,
                'min_order' => 100,
                'max_order' => 50000,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 7,
                'platform_id' => 1, // TikTok
                'nama' => 'Likes TikTok',
                'slug' => 'likes-tiktok',
                'provider_service_id' => '4379',
                'provider_service_id_alt' => null,
                'min_order' => 100,
                'max_order' => 100000,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $db->table('sosmed_layanan')->insertBatch($layanans);

        // 3. Insert Paket
        $pakets = [
            // Instagram Followers (100: 10k, 200: 18k, 500: 40k, 1000: 70k)
            ['layanan_id' => 1, 'jumlah' => 100, 'harga' => 10000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['layanan_id' => 1, 'jumlah' => 200, 'harga' => 18000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['layanan_id' => 1, 'jumlah' => 500, 'harga' => 40000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['layanan_id' => 1, 'jumlah' => 1000, 'harga' => 70000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],

            // Instagram Likes (100: 5k, 200: 8k, 500: 15k, 1000: 25k)
            ['layanan_id' => 2, 'jumlah' => 100, 'harga' => 5000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['layanan_id' => 2, 'jumlah' => 200, 'harga' => 8000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['layanan_id' => 2, 'jumlah' => 500, 'harga' => 15000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['layanan_id' => 2, 'jumlah' => 1000, 'harga' => 25000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],

            // Instagram Views (1k: 2k, 10k: 15k, 100k: 110k)
            ['layanan_id' => 3, 'jumlah' => 1000, 'harga' => 2000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['layanan_id' => 3, 'jumlah' => 10000, 'harga' => 15000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['layanan_id' => 3, 'jumlah' => 100000, 'harga' => 110000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],

            // TikTok Views (1k: 2k, 10k: 15k, 100k: 110k)
            ['layanan_id' => 4, 'jumlah' => 1000, 'harga' => 2000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['layanan_id' => 4, 'jumlah' => 10000, 'harga' => 15000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['layanan_id' => 4, 'jumlah' => 100000, 'harga' => 110000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],

            // TikTok Followers LQ (100: 10k, 500: 42k, 1000: 70k)
            ['layanan_id' => 5, 'jumlah' => 100, 'harga' => 10000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['layanan_id' => 5, 'jumlah' => 500, 'harga' => 42000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['layanan_id' => 5, 'jumlah' => 1000, 'harga' => 70000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],

            // TikTok Followers HQ (100: 20k, 500: 70k, 1000: 120k)
            ['layanan_id' => 6, 'jumlah' => 100, 'harga' => 20000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['layanan_id' => 6, 'jumlah' => 500, 'harga' => 70000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['layanan_id' => 6, 'jumlah' => 1000, 'harga' => 120000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],

            // TikTok Likes (100: 5k, 500: 18k, 1000: 30k)
            ['layanan_id' => 7, 'jumlah' => 100, 'harga' => 5000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['layanan_id' => 7, 'jumlah' => 500, 'harga' => 18000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['layanan_id' => 7, 'jumlah' => 1000, 'harga' => 30000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
        ];
        $db->table('sosmed_paket')->insertBatch($pakets);
    }
}
