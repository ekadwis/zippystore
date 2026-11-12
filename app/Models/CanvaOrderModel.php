<?php

namespace App\Models;

use CodeIgniter\Model;

class CanvaOrderModel extends Model
{
    protected $table            = 'canva_orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'order_code',
        'customer_email',
        'customer_wa',
        'durasi_label',
        'durasi_bulan',
        'harga',
        'invite_link_sent',
        'status_pembayaran',
        'status_email',
        'email_error',
        'payment_reference',
        'payment_url',
        'payment_method',
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

