<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLinkToGaleri extends Migration
{
    public function up()
    {
        $fields = [
            'link' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'kategori',
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'link',
            ],
        ];

        $this->forge->addColumn('galeri', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('galeri', ['link', 'deskripsi']);
    }
}
