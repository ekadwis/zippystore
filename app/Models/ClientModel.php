<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table            = 'client';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useTimestamps    = false;

    protected $allowedFields = [
        'nama', 'logo', 'deskripsi', 'is_active', 'created_at',
    ];

    public function getActive()
    {
        return $this->where('is_active', 1)->orderBy('id', 'DESC')->findAll();
    }
}