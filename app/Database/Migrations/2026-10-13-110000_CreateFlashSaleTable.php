<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFlashSaleTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'judul' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'default'    => '⚡ FLASH SALE TERBATAS — SPESIAL HARI INI',
            ],
            'subjudul' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'default'    => 'Klaim diskon khusus kuota terbatas untuk aplikasi premium, asistensi tugas IT/Excel, dan sosmed growth sebelum hitung mundur selesai!',
            ],
            'badge_text' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => '🔥 PROMO FLASH SALE',
            ],
            'end_time' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'items_json' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('flash_sale', true);
    }

    public function down()
    {
        $this->forge->dropTable('flash_sale', true);
    }
}
