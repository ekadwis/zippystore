<?php

namespace App\Controllers;

use App\Models\OtpProdukModel;
use App\Models\PengaturanModel;

class OtpController extends BaseController
{
    public function index()
    {
        $set = (new PengaturanModel())->getSettings();
        $wa  = !empty($set['no_wa']) ? preg_replace('/[^0-9]/', '', $set['no_wa']) : '6285177838705';

        $ketentuan = [
            'OTP hanya berlangsung 15 menit sejak orderan dibuat. Lewat dari 15 menit, OTP tidak bisa diproses.',
            'Garansi gagal login. Jika sudah berhasil login, garansi tidak berlaku lagi.',
            'Strong number — nomor berkualitas.',
            'Hanya nomor Indonesia, namun bisa semua operator.',
            'Harga sewaktu-waktu dapat berubah tanpa pemberitahuan.',
        ];

        return view('otp/index', [
            'title'      => 'Nomor OTP - Zippy Store',
            'produks'    => (new OtpProdukModel())->getActive(),
            'ketentuan'  => $ketentuan,
            'waNumber'   => $wa,
            'pengaturan' => $set,
        ]);
    }
}