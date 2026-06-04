<?php

namespace App\Models;

use CodeIgniter\Model;

class StatistikModel extends Model
{
    protected $table         = 'statistik';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['icon', 'angka', 'label', 'urutan', 'is_active'];

    public function getActive()
    {
        return $this->where('is_active', 1)->orderBy('urutan', 'ASC')->findAll();
    }

    public function getAll()
    {
        return $this->orderBy('urutan', 'ASC')->findAll();
    }
}