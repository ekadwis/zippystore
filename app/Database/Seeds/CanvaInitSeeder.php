<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CanvaInitSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // 1. Inisialisasi Settings Canva
        $inviteLink = 'https://www.canva.com/brand/join?token=ibkh_1NHJWWtkTc517IRdQ&brandingVariant=edu&referrer=team-invite';
        
        $db->table('canva_settings')->emptyTable();
        $db->table('canva_settings')->insert([
            'id'          => 1,
            'nama_produk' => 'Canva PRO EDU',
            'team_name'   => 'AEZ Team',
            'invite_link' => $inviteLink,
            'is_active'   => 1,
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // 2. Tambah / Update Produk Canva di premium_produk
        $existingCanva = $db->table('premium_produk')->where('slug', 'canva-pro-edu')->get()->getRowArray();
        $produkId = null;

        if ($existingCanva) {
            $produkId = $existingCanva['id'];
            $db->table('premium_produk')->where('id', $produkId)->update([
                'nama'      => 'Canva PRO EDU',
                'deskripsi' => 'Akses resmi tim AEZ Team (Canva PRO EDU) invite via email otomatis. Semua template, elemen, dan fitur pro terbuka!',
                'icon'      => '🎨',
                'is_active' => 1,
            ]);
        } else {
            $db->table('premium_produk')->insert([
                'nama'       => 'Canva PRO EDU',
                'slug'       => 'canva-pro-edu',
                'deskripsi'  => 'Akses resmi tim AEZ Team (Canva PRO EDU) invite via email otomatis. Semua template, elemen, dan fitur pro terbuka!',
                'icon'       => '🎨',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            $produkId = $db->insertID();
        }

        // 3. Durasi & Harga Resmi Canva PRO EDU:
        // 1 bulan: 3k, 3 bulan: 6k, 6 bulan: 10k, 12 bulan: 15k
        $db->table('premium_durasi')->where('produk_id', $produkId)->delete();
        $durasiList = [
            ['produk_id' => $produkId, 'label' => '1 Bulan (Garansi 25-30 Hari)', 'durasi_hari' => 30, 'harga' => 3000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['produk_id' => $produkId, 'label' => '3 Bulan (Garansi Penuh)', 'durasi_hari' => 90, 'harga' => 6000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['produk_id' => $produkId, 'label' => '6 Bulan (Garansi Penuh)', 'durasi_hari' => 180, 'harga' => 10000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
            ['produk_id' => $produkId, 'label' => '12 Bulan / 1 Tahun (Best Deal)', 'durasi_hari' => 365, 'harga' => 15000, 'is_active' => 1, 'created_at' => date('Y-m-d H:i:s')],
        ];
        $db->table('premium_durasi')->insertBatch($durasiList);
    }
}

