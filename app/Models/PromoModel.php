<?php

namespace App\Models;

use CodeIgniter\Model;

class PromoModel extends Model
{
    protected $table         = 'promo';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['kode', 'diskon', 'deskripsi', 'valid_until', 'is_active'];

    public function getActive()
    {
        return $this->where('is_active', 1)->orderBy('id', 'DESC')->findAll();
    }

    public function getAll()
    {
        return $this->orderBy('id', 'DESC')->findAll();
    }
}