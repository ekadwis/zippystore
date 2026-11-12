<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCanvaOrdersAndSettingsTable extends Migration
{
    public function up()
    {
        // 1. TABEL PENGATURAN LINK & PRODUK CANVA
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => 'Canva PRO EDU',
            ],
            'team_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => 'AEZ Team',
            ],
            'invite_link' => [
                'type' => 'TEXT',
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('canva_settings', true);

        // 2. TABEL TRANSAKSI CANVA ORDERS
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'order_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'unique'     => true,
            ],
            'customer_email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'customer_wa' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
            ],
            'durasi_label' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'durasi_bulan' => [
                'type'       => 'INT',
                'constraint' => 5,
                'default'    => 1,
            ],
            'harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
                'default'    => 0.00,
            ],
            'invite_link_sent' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status_pembayaran' => [
                'type'       => 'ENUM',
                'constraint' => ['unpaid', 'paid', 'expired'],
                'default'    => 'unpaid',
            ],
            'status_email' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'sent', 'failed'],
                'default'    => 'pending',
            ],
            'email_error' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'payment_reference' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'payment_url' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'payment_method' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'QRIS',
            ],
            'catatan' => [
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
        $this->forge->createTable('canva_orders', true);
    }

    public function down()
    {
        $this->forge->dropTable('canva_orders', true);
        $this->forge->dropTable('canva_settings', true);
    }
}
