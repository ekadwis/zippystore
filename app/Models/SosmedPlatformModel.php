<?php

namespace App\Models;

use CodeIgniter\Model;

class SosmedPlatformModel extends Model
{
    protected $table         = 'sosmed_platform';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['nama', 'slug', 'icon', 'is_active', 'created_at'];

    public function getActive()
    {
        return $this->where('is_active', 1)->orderBy('id', 'ASC')->findAll();
    }
}