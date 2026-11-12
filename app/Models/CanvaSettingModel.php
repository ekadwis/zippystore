<?php

namespace App\Models;

use CodeIgniter\Model;

class CanvaSettingModel extends Model
{
    protected $table            = 'canva_settings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nama_produk',
        'team_name',
        'invite_link',
        'is_active',
        'updated_at',
    ];

    public function getSettings()
    {
        $res = $this->find(1);
        if (!$res) {
            $defaultLink = 'https://www.canva.com/brand/join?token=ibkh_1NHJWWtkTc517IRdQ&brandingVariant=edu&referrer=team-invite';
            $this->insert([
                'id'          => 1,
                'nama_produk' => 'Canva PRO EDU',
                'team_name'   => 'AEZ Team',
                'invite_link' => $defaultLink,
                'is_active'   => 1,
                'updated_at'  => date('Y-m-d H:i:s'),
            ]);
            return $this->find(1);
        }
        return $res;
    }
}

