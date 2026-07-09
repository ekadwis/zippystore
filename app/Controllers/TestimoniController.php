<?php

namespace App\Controllers;

use App\Libraries\TelegramChannel;
use App\Models\PengaturanModel;
use App\Models\TestimoniModel;

class TestimoniController extends BaseController
{
    public function index()
    {
        // Ambil testimoni dari database (diisi via admin panel atau sync Telegram)
        $testimoniModel = new TestimoniModel();
        $photos = $testimoniModel->where('is_active', 1)
                                 ->orderBy('id', 'DESC')
                                 ->findAll(16);

        $channelUrl = 'https://t.me/' . env('telegram.channelUsername', 'klddies');

        $data = [
            'title'         => 'Kata Mereka - Testimoni Zippy Store',
            'testimoni'     => $photos,
            'totalTesti'    => count($photos),
            'telegramLink'  => $channelUrl,
            'fromTelegram'  => false,
            'pengaturan'    => (new PengaturanModel())->getSettings(),
        ];

        return view('testimonials/index', $data);
    }

    /**
     * Sync foto baru dari channel Telegram ke database.
     * Dipanggil dari admin panel atau cron job.
     */
    public function syncTelegram()
    {
        $telegram = new TelegramChannel();

        if (!$telegram->isConfigured()) {
            return redirect()->to(site_url('testimonials'))
                             ->with('error', 'Telegram Bot belum dikonfigurasi.');
        }

        $saved = $telegram->syncToDatabase();

        $msg = $saved > 0
            ? "Berhasil sync {$saved} foto baru dari Telegram."
            : 'Tidak ada foto baru dari Telegram.';

        return redirect()->to(site_url('testimonials'))
                         ->with('success', $msg);
    }
}