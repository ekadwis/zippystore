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

        // Kategori cakupan asistensi sesuai identitas.md (Hero Service)
        $kategoriList = [
            'IT & Web Development (Coding, Website, Debug, Skripsi IT)',
            'Olah Data (Microsoft Excel, Google Sheets, Rumus & Otomatisasi)',
            'Administrasi (CV ATS-Friendly, Surat Resmi, Dokumen Formal)',
            'Tugas Akademik (Makalah, Laporan, Esai, Tugas Kuliah/Sekolah)',
            'Bidang Tambahan (Pendidikan, Sains, Hukum via Jaringan Mitra)',
        ];

        // SOP Kualitas & Regulasi Asistensi sesuai identitas.md
        $ketentuan = [
            'Gratis 1–2 kali revisi minor sesuai dengan brief dan kesepakatan awal saat pemesanan.',
            'Fee pengerjaan dihitung secara transparan berdasarkan tingkat kesulitan tugas, volume, dan deadline.',
            'Menerima rush order / deadline mendesak dengan penyesuaian biaya pengerjaan.',
            'Wajib Down Payment (DP) minimal 50% atau full payment via QRIS sebelum tugas mulai dikerjakan.',
            'Kerahasiaan data, file tugas, dan identitas pemesan dijamin 100% aman dan privat.',
            'Revisi tambahan di luar brief awal atau setelah kuota habis dapat didiskusikan dengan biaya penyesuaian yang wajar.',
        ];

        return view('joki/index', [
            'title'        => 'Asistensi Tugas & IT — Jasa Joki Profesional Zippy Store',
            'waNumber'     => $wa,
            'kategoriList' => $kategoriList,
            'ketentuan'    => $ketentuan,
            'pengaturan'   => $set,
        ]);
    }
}