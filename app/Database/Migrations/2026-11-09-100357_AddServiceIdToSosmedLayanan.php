<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddServiceIdToSosmedLayanan extends Migration
{
    public function up()
    {
        $fields = [
            'provider_service_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'after'      => 'slug',
            ],
            'provider_service_id_alt' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'after'      => 'provider_service_id',
            ],
        ];

        $this->forge->addColumn('sosmed_layanan', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('sosmed_layanan', ['provider_service_id', 'provider_service_id_alt']);
    }
}
