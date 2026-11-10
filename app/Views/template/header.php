<?php
$set = $pengaturan ?? [];
$namaToko = $set['nama_toko'] ?? 'Zippy Store';
$waNumber = !empty($set['no_wa']) ? preg_replace('/[^0-9]/', '', $set['no_wa']) : '6285177838705';
$waLink   = 'https://wa.me/' . $waNumber;
$current  = uri_string();
$isLayananActive = in_array($current, ['joki', 'premium', 'sosmed', 'otp']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($title ?? ($namaToko . ' — Layanan Kebutuhan Digital & Asistensi Terpercaya')) ?></title>
  <meta name="description" content="<?= esc($set['deskripsi'] ?? 'Zippy Store (zippystore.my.id) — Layanan kebutuhan digital, aplikasi premium bergaransi, asistensi tugas & IT, serta social media growth terpercaya sejak 2019.') ?>">
  <meta name="keywords" content="zippy store, zippystore.my.id, joki tugas, asistensi it, coding skripsi, excel sheets, spotify premium, netflix murah, youtube premium, smm panel, followers instagram tiktok">
  <?php if (!empty($set['favicon'])): ?>
    <link rel="icon" href="<?= base_url($set['favicon']) ?>">
  <?php endif; ?>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome 6 CDN (Icon WhatsApp & Brand) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- Tema custom -->
  <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>

<body>

  <nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand d-inline-flex align-items-center gap-2" href="<?= base_url('/') ?>">
        <span class="brand-text"><?= esc($namaToko) ?></span>
        <span class="badge-est">EST. 2019</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
          <li class="nav-item">
            <a class="nav-link <?= $current === '' ? 'active' : '' ?>" href="<?= base_url('/') ?>">Beranda</a>
          </li>

          <!-- DROPDOWN LAYANAN TERPADU (Ringkas & Rapi) -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle <?= $isLayananActive ? 'active fw-bold' : '' ?>" href="#" id="dropdownLayanan" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Layanan
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-2" aria-labelledby="dropdownLayanan" style="border-radius:10px; border-color:#18181b">
              <li>
                <a class="dropdown-item py-2 d-flex align-items-center gap-2 <?= $current === 'joki' ? 'active' : '' ?>" href="<?= base_url('joki') ?>">
                  <span class="nav-dot dot-amber"></span> Asistensi &amp; Joki IT/Tugas
                </a>
              </li>
              <li>
                <a class="dropdown-item py-2 d-flex align-items-center gap-2 <?= $current === 'premium' ? 'active' : '' ?>" href="<?= base_url('premium') ?>">
                  <span class="nav-dot dot-blue"></span> Aplikasi Premium
                </a>
              </li>
              <li>
                <a class="dropdown-item py-2 d-flex align-items-center gap-2 <?= $current === 'sosmed' ? 'active' : '' ?>" href="<?= base_url('sosmed') ?>">
                  <span class="nav-dot dot-emerald"></span> Social Media Growth (SMM)
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link <?= $current === 'cara-pesan' ? 'active' : '' ?>" href="<?= base_url('cara-pesan') ?>">Cara Pesan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $current === 'testimonials' ? 'active' : '' ?>" href="<?= base_url('testimonials') ?>">Testimoni</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $current === 'gallery' ? 'active' : '' ?>" href="<?= base_url('gallery') ?>">Galeri</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $current === 'about' ? 'active' : '' ?>" href="<?= base_url('about') ?>">Tentang Kami</a>
          </li>

          <!-- ICON WHATSAPP CHAT (Ringkas & Modern) -->
          <li class="nav-item ms-lg-2 my-2 my-lg-0">
            <a class="btn btn-wa-icon d-inline-flex align-items-center justify-content-center" href="<?= esc($waLink) ?>" target="_blank" rel="noopener" title="Chat WhatsApp Kami" style="width:38px; height:38px; border-radius:50%; background:#25D366; color:#ffffff; font-size:1.15rem; border:2px solid #18181b; box-shadow:2px 2px 0px 0px #18181b; text-decoration:none;">
              <i class="fab fa-whatsapp"></i>
            </a>
          </li>

          <li class="nav-item ms-lg-1">
            <a class="nav-link text-muted-2 small px-2" href="<?= base_url('login') ?>" title="Admin Portal">
              Portal
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
