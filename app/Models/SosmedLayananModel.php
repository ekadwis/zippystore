<?php

namespace App\Models;

use CodeIgniter\Model;

class SosmedLayananModel extends Model
{
    protected $table         = 'sosmed_layanan';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['platform_id', 'nama', 'slug', 'min_order', 'max_order', 'is_active', 'created_at'];

    // Layanan + nama platform
    public function getWithPlatform($onlyActive = false)
    {
        $b = $this->select('sosmed_layanan.*, sosmed_platform.nama AS platform_nama, sosmed_platform.slug AS platform_slug')
                  ->join('sosmed_platform', 'sosmed_platform.id = sosmed_layanan.platform_id');
        if ($onlyActive) {
            $b->where('sosmed_layanan.is_active', 1);
        }
        return $b->orderBy('sosmed_layanan.platform_id', 'ASC')->findAll();
    }

    public function getByPlatform($platformId)
    {
        return $this->where('platform_id', $platformId)->where('is_active', 1)->findAll();
    }
}