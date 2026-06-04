<?php

namespace App\Models;

use CodeIgniter\Model;

class PremiumProdukModel extends Model
{
    protected $table         = 'premium_produk';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['nama', 'slug', 'deskripsi', 'icon', 'is_active', 'created_at'];

    public function getActive()
    {
        return $this->where('is_active', 1)->orderBy('id', 'ASC')->findAll();
    }
}