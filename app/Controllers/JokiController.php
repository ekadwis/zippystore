<?php

namespace App\Controllers;

use App\Models\PengaturanModel;

class JokiController extends BaseController
{
    public function index()
    {
        $set = (new PengaturanModel())->getSettings();
        $wa  = !empty($set['no_wa'])
             ? preg_replace('/[^0-9]/', '', $set['no_wa'])
             : '6285177838705';

        // Ketentuan layanan joki
        $ketentuan = [
            'Fee menyesuaikan tingkat kesulitan tugas dan masih bisa dinegosiasi.',
            'Menerima inrush (deadline mepet), namun fee akan lebih mahal.',
            'Gratis revisi 1x, selama masih sesuai dengan kesepakatan awal.',
            'Wajib DP minimal 50% sebelum tugas mulai diproses.',
            'Jika tugas dibatalkan saat proses pengerjaan, DP tidak dapat dikembalikan.',
        ];

        return view('joki/index', [
            'title'      => 'Joki Tugas - Zippy Store',
            'waNumber'   => $wa,
            'ketentuan'  => $ketentuan,
            'pengaturan' => $set,
        ]);
    }
}