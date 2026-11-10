<?php

namespace App\Models;

use CodeIgniter\Model;

class SosmedOrderModel extends Model
{
    protected $table            = 'sosmed_orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'order_code',
        'platform_nama',
        'layanan_id',
        'layanan_nama',
        'target',
        'jumlah',
        'harga',
        'wa_buyer',
        'provider_service_id',
        'provider_order_id',
        'status_order',
        'status_pembayaran',
        'provider_response',
        'catatan',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findByCode(string $code)
    {
        return $this->where('order_code', $code)->first();
    }
}

