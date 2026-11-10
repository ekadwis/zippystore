<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBatchFieldsToSosmedOrders extends Migration
{
    public function up()
    {
        $fields = [
            'is_mass' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
                'after'      => 'order_code',
            ],
            'mass_data' => [
                'type' => 'LONGTEXT',
                'null' => true,
                'after' => 'target',
            ],
            'mass_count' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 1,
                'after'      => 'jumlah',
            ],
        ];

        $this->forge->addColumn('sosmed_orders', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('sosmed_orders', ['is_mass', 'mass_data', 'mass_count']);
    }
}
