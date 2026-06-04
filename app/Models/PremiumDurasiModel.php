<?php

namespace App\Models;

use CodeIgniter\Model;

class PremiumDurasiModel extends Model
{
    protected $table         = 'premium_durasi';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['produk_id', 'label', 'durasi_hari', 'harga', 'is_active', 'created_at'];

    // Durasi + nama produk (untuk list admin)
    public function getWithProduk($onlyActive = false)
    {
        $b = $this->select('premium_durasi.*, premium_produk.nama AS produk_nama')
                  ->join('premium_produk', 'premium_produk.id = premium_durasi.produk_id');
        if ($onlyActive) {
            $b->where('premium_durasi.is_active', 1);
        }
        return $b->orderBy('premium_durasi.produk_id', 'ASC')
                 ->orderBy('premium_durasi.durasi_hari', 'ASC')
                 ->findAll();
    }

    public function getByProduk($produkId)
    {
        return $this->where('produk_id', $produkId)
                    ->where('is_active', 1)
                    ->orderBy('durasi_hari', 'ASC')
                    ->findAll();
    }
}