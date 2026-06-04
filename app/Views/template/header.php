<?php
$set = $pengaturan ?? [];
$namaToko = $set['nama_toko'] ?? 'Zippy Store';
$current = uri_string();
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($title ?? $namaToko) ?></title>
  <meta name="description" content="<?= esc($set['deskripsi'] ?? 'Solusi digital termudah dan termurah.') ?>">
  <?php if (!empty($set['favicon'])): ?>
    <link rel="icon" href="<?= base_url($set['favicon']) ?>">
  <?php endif; ?>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- Tema custom -->
  <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>

<body>

  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url('/') ?>"><?= esc($namaToko) ?><span>.</span></a>
      <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon" style="filter:invert(1)"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
          <li class="nav-item"><a class="nav-link <?= $current === '' ? 'active' : '' ?>" href="<?= base_url('/') ?>">Home</a></li>
          <li class="nav-item"><a class="nav-link <?= $current === 'about' ? 'active' : '' ?>" href="<?= base_url('about') ?>">About</a></li>
          <li class="nav-item"><a class="nav-link <?= $current === 'testimonials' ? 'active' : '' ?>" href="<?= base_url('testimonials') ?>">Testimoni</a></li>
          <li class="nav-item"><a class="nav-link <?= $current === 'cara-pesan' ? 'active' : '' ?>" href="<?= base_url('cara-pesan') ?>">Cara Pesan</a></li>
          <li class="nav-item"><a class="nav-link <?= $current === 'gallery' ? 'active' : '' ?>" href="<?= base_url('gallery') ?>">Gallery</a></li>
          <li class="nav-item ms-lg-2"><a class="btn btn-outline-accent btn-sm px-3" href="<?= base_url('login') ?>">Login</a></li>
        </ul>
      </div>
    </div>
  </nav>