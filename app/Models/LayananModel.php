<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananModel extends Model
{
    protected $table            = 'layanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useTimestamps    = false;

    protected $allowedFields = [
        'nama', 'slug', 'deskripsi', 'icon', 'is_active', 'created_at',
    ];

    // Ambil layanan yang aktif saja
    public function getActive()
    {
        return $this->where('is_active', 1)->orderBy('id', 'ASC')->findAll();
    }
}