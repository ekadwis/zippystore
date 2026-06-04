<?php

namespace App\Models;

use CodeIgniter\Model;

class SosmedPaketModel extends Model
{
    protected $table         = 'sosmed_paket';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['layanan_id', 'jumlah', 'harga', 'is_active', 'created_at'];

    // Paket + info layanan + platform (untuk list di dashboard)
    public function getWithInfo($onlyActive = false)
    {
        $b = $this->select('sosmed_paket.*,
                            sosmed_layanan.nama AS layanan_nama,
                            sosmed_platform.nama AS platform_nama')
                  ->join('sosmed_layanan', 'sosmed_layanan.id = sosmed_paket.layanan_id')
                  ->join('sosmed_platform', 'sosmed_platform.id = sosmed_layanan.platform_id');
        if ($onlyActive) {
            $b->where('sosmed_paket.is_active', 1);
        }
        return $b->orderBy('sosmed_platform.id', 'ASC')
                 ->orderBy('sosmed_layanan.id', 'ASC')
                 ->orderBy('sosmed_paket.jumlah', 'ASC')
                 ->findAll();
    }

    // Semua paket aktif suatu layanan, urut jumlah
    public function getByLayanan($layananId)
    {
        return $this->where('layanan_id', $layananId)
                    ->where('is_active', 1)
                    ->orderBy('jumlah', 'ASC')
                    ->findAll();
    }
}