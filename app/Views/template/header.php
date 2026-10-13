<?php
$set = $pengaturan ?? [];
$namaToko = $set['nama_toko'] ?? 'Zippy Store';
$waNumber = !empty($set['no_wa']) ? preg_replace('/[^0-9]/', '', $set['no_wa']) : '6285177838705';
$waLink   = 'https://wa.me/' . $waNumber;
$current  = uri_string();
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
  <!-- Google Fonts: Plus Jakarta Sans & Outfit (Editorial, High-Intent Sans) -->
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
        <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
          <li class="nav-item">
            <a class="nav-link <?= $current === '' ? 'active' : '' ?>" href="<?= base_url('/') ?>">Beranda</a>
          </li>
          <!-- 3 PILAR LAYANAN -->
          <li class="nav-item">
            <a class="nav-link nav-highlight-joki <?= $current === 'joki' ? 'active' : '' ?>" href="<?= base_url('joki') ?>">
              <span class="nav-dot dot-amber"></span>Asistensi &amp; Joki
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-highlight-app <?= $current === 'premium' ? 'active' : '' ?>" href="<?= base_url('premium') ?>">
              <span class="nav-dot dot-blue"></span>App Premium
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-highlight-sosmed <?= $current === 'sosmed' ? 'active' : '' ?>" href="<?= base_url('sosmed') ?>">
              <span class="nav-dot dot-emerald"></span>Sosmed Growth
            </a>
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
          <li class="nav-item ms-lg-2 my-2 my-lg-0">
            <a class="btn btn-wa-nav btn-sm px-3 py-1" href="<?= esc($waLink) ?>" target="_blank" rel="noopener">
              <span class="live-pulse"></span> Chat WhatsApp
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