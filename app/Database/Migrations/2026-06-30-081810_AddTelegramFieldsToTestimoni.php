<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTelegramFieldsToTestimoni extends Migration
{
    public function up()
    {
        // Tambah kolom telegram_file_id dan telegram_msg_id jika belum ada
        $fields = [
            'telegram_file_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'default'    => null,
                'after'      => 'is_active',
            ],
            'telegram_msg_id' => [
                'type'    => 'BIGINT',
                'null'    => true,
                'default' => null,
                'after'   => 'telegram_file_id',
            ],
        ];

        $this->forge->addColumn('testimoni', $fields);

        // Tambah unique index pada telegram_file_id untuk mencegah duplikasi
        $this->db->query('ALTER TABLE `testimoni` ADD UNIQUE INDEX `idx_telegram_file_id` (`telegram_file_id`)');
    }

    public function down()
    {
        $this->forge->dropColumn('testimoni', 'telegram_file_id');
        $this->forge->dropColumn('testimoni', 'telegram_msg_id');
    }
}