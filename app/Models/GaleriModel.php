<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriModel extends Model
{
    protected $table         = 'galeri';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['nama', 'file', 'kategori', 'is_active', 'created_at'];

    // Publik: filter kategori + pencarian nama (hanya aktif)
    public function getFiltered($kategori = null, $keyword = null)
    {
        $builder = $this->where('is_active', 1);

        if (! empty($kategori) && $kategori !== 'semua') {
            $builder = $builder->where('kategori', $kategori);
        }
        if (! empty($keyword)) {
            $builder = $builder->like('nama', $keyword);
        }
        return $builder->orderBy('id', 'DESC')->findAll();
    }

    // Admin: semua data
    public function getAll()
    {
        return $this->orderBy('id', 'DESC')->findAll();
    }
}