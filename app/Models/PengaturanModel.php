<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaturanModel extends Model
{
    protected $table            = 'pengaturan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false; // id selalu 1
    protected $returnType       = 'array';
    protected $useTimestamps    = false;

    protected $allowedFields = [
        'nama_toko', 'deskripsi', 'email', 'no_wa',
        'ig_link', 'tele_link', 'twitter_link', 'alamat', 'logo', 'favicon',
    ];

    // Settings selalu baris id = 1
    public function getSettings()
    {
        return $this->find(1);
    }
}