<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaturanModel extends Model
{
    protected $table         = 'pengaturan';
    protected $primaryKey    = 'id';
    protected $useAutoIncrement = false;
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'nama_toko', 'deskripsi', 'email', 'no_wa',
        'ig_link', 'tele_link', 'twitter_link', 'alamat', 'logo', 'favicon',
    ];

    public function getSettings()
    {
        return $this->find(1);
    }

    public function saveSettings(array $data)
    {
        if ($this->find(1)) {
            return $this->update(1, $data);
        }
        $data['id'] = 1;
        return $this->insert($data);
    }
}