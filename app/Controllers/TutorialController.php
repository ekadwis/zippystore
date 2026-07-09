<?php

namespace App\Controllers;

use App\Models\PengaturanModel;

class TutorialController extends BaseController
{
    public function index()
    {
        return view('tutorial/index', [
            'title'      => 'Tutorial Gratis - Zippy Store',
            'pengaturan' => (new PengaturanModel())->getSettings(),
        ]);
    }

    public function geminiPro()
    {
        return view('tutorial/gemini-pro', [
            'title'      => 'Tutorial Gemini PRO 1 Tahun - Zippy Store',
            'pengaturan' => (new PengaturanModel())->getSettings(),
        ]);
    }

    public function cloudflareGlm()
    {
        return view('tutorial/cloudflare-glm', [
            'title'      => 'Claim GLM 5.2 & Kimi via Cloudflare - Zippy Store',
            'pengaturan' => (new PengaturanModel())->getSettings(),
        ]);
    }
}