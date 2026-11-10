<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPaymentFieldsToSosmedOrders extends Migration
{
    public function up()
    {
        $fields = [
            'payment_reference' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'after'      => 'status_pembayaran',
            ],
            'payment_url' => [
                'type'       => 'TEXT',
                'null'       => true,
                'after'      => 'payment_reference',
            ],
            'payment_method' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'after'      => 'payment_url',
            ],
        ];

        $this->forge->addColumn('sosmed_orders', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('sosmed_orders', ['payment_reference', 'payment_url', 'payment_method']);
    }
}
