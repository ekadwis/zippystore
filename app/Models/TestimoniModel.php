<?php

namespace App\Models;

use CodeIgniter\Model;

class TestimoniModel extends Model
{
    protected $table         = 'testimoni';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['nama', 'isi', 'gambar', 'tanggal', 'is_active', 'created_at', 'telegram_file_id', 'telegram_msg_id'];

    // Front-end: hanya yang aktif
    public function getActive()
    {
        return $this->where('is_active', 1)
                    ->orderBy('tanggal', 'DESC')
                    ->findAll();
    }

    // Admin: semua, terbaru dulu
    public function getAll()
    {
        return $this->orderBy('tanggal', 'DESC')->findAll();
    }
}