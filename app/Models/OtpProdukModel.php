<?php

namespace App\Models;

use CodeIgniter\Model;

class OtpProdukModel extends Model
{
    protected $table         = 'otp_produk';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['nama', 'harga', 'icon', 'is_active', 'created_at'];

    public function getActive()
    {
        return $this->where('is_active', 1)->orderBy('nama', 'ASC')->findAll();
    }

    public function getAll()
    {
        return $this->orderBy('nama', 'ASC')->findAll();
    }
}