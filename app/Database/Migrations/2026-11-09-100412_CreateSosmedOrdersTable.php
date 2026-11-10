<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSosmedOrdersTable extends Migration
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
            'order_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'unique'     => true,
            ],
            'platform_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'layanan_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'layanan_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'target' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'jumlah' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
                'default'    => 0.00,
            ],
            'wa_buyer' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
            ],
            'provider_service_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'provider_order_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'status_order' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'processing', 'completed', 'partial', 'canceled', 'failed'],
                'default'    => 'pending',
            ],
            'status_pembayaran' => [
                'type'       => 'ENUM',
                'constraint' => ['unpaid', 'paid', 'expired', 'refunded'],
                'default'    => 'paid',
            ],
            'provider_response' => [
                'type' => 'TEXT',
                'null' => true,
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
        $this->forge->createTable('sosmed_orders', true);
    }

    public function down()
    {
        $this->forge->dropTable('sosmed_orders', true);
    }
}
