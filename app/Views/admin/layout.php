<?php
  $current = uri_string(); // contoh: admin/sosmed/paket
  function isActive($needle, $current) {
      return str_starts_with($current, $needle) ? 'active' : '';
  }
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($title ?? 'Admin') ?> - Zippy Store</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('css/admin-sosmed.css') ?>">
</head>
<body>
<div class="admin-wrap">

  <!-- SIDEBAR -->
  <aside class="sidebar" id="sidebar">
    <a href="<?= site_url('admin/sosmed') ?>" class="brand">Zippy<span>.</span></a>

    <!-- ===== LAYANAN ===== -->
    <div class="sb-label">Layanan</div>
    <nav class="nav flex-column">
      <a class="nav-link <?= str_contains($current,'admin/sosmed') ? 'active' : '' ?>" href="<?= site_url('admin/sosmed') ?>">🚀 Sosmed Boost</a>
      <a class="nav-link <?= str_contains($current,'admin/premium') ? 'active' : '' ?>" href="<?= site_url('admin/premium') ?>">🎬 App Premium</a>
      <a class="nav-link <?= str_contains($current,'admin/otp') ? 'active' : '' ?>" href="<?= site_url('admin/otp') ?>">📱 Nomor OTP</a>
    </nav>

    <!-- Sub-menu Sosmed Boost (muncul saat di halaman sosmed) -->
    <?php if (str_contains($current, 'admin/sosmed')): ?>
      <div class="sb-label">Menu Sosmed</div>
      <nav class="nav flex-column">
        <a class="nav-link <?= $current === 'admin/sosmed' ? 'active' : '' ?>" href="<?= site_url('admin/sosmed') ?>">📊 Dashboard</a>
        <a class="nav-link <?= str_contains($current,'platform') ? 'active' : '' ?>" href="<?= site_url('admin/sosmed/platform') ?>">🌐 Platform</a>
        <a class="nav-link <?= str_contains($current,'layanan') ? 'active' : '' ?>" href="<?= site_url('admin/sosmed/layanan') ?>">🧩 Layanan</a>
        <a class="nav-link <?= str_contains($current,'paket') ? 'active' : '' ?>" href="<?= site_url('admin/sosmed/paket') ?>">📦 Paket</a>
        <a class="nav-link <?= str_contains($current,'kalkulator') ? 'active' : '' ?>" href="<?= site_url('admin/sosmed/kalkulator') ?>">🧮 Kalkulator</a>
      </nav>
    <?php endif; ?>

    <!-- Sub-menu App Premium (muncul saat di halaman premium) -->
    <?php if (str_contains($current, 'admin/premium')): ?>
      <div class="sb-label">Menu Premium</div>
      <nav class="nav flex-column">
        <a class="nav-link <?= $current === 'admin/premium' ? 'active' : '' ?>" href="<?= site_url('admin/premium') ?>">📊 Dashboard</a>
        <a class="nav-link <?= str_contains($current,'produk') ? 'active' : '' ?>" href="<?= site_url('admin/premium/produk') ?>">📦 Produk</a>
        <a class="nav-link <?= str_contains($current,'durasi') ? 'active' : '' ?>" href="<?= site_url('admin/premium/durasi') ?>">⏱️ Durasi & Harga</a>
      </nav>
    <?php endif; ?>

    <!-- ===== KONTEN ===== -->
    <div class="sb-label">Konten</div>
    <nav class="nav flex-column">
      <a class="nav-link <?= str_contains($current,'admin/testimoni') ? 'active' : '' ?>" href="<?= site_url('admin/testimoni') ?>">💬 Testimoni</a>
      <a class="nav-link <?= str_contains($current,'admin/galeri') ? 'active' : '' ?>" href="<?= site_url('admin/galeri') ?>">🖼️ Galeri</a>
      <a class="nav-link <?= str_contains($current,'admin/statistik') ? 'active' : '' ?>" href="<?= site_url('admin/statistik') ?>">📊 Statistik</a>
      <a class="nav-link <?= str_contains($current,'admin/client') ? 'active' : '' ?>" href="<?= site_url('admin/client') ?>">🤝 Client</a>
      <a class="nav-link <?= str_contains($current,'admin/promo') ? 'active' : '' ?>" href="<?= site_url('admin/promo') ?>">🎁 Promo</a>
    </nav>

    <!-- ===== PENGATURAN ===== -->
    <div class="sb-label">Pengaturan</div>
    <nav class="nav flex-column">
      <a class="nav-link <?= str_contains($current,'admin/pengaturan') ? 'active' : '' ?>" href="<?= site_url('admin/pengaturan') ?>">⚙️ Pengaturan</a>
      <a class="nav-link" href="<?= site_url('/') ?>" target="_blank">🏠 Lihat Website</a>
      <a class="nav-link" href="<?= site_url('logout') ?>">🚪 Logout</a>
    </nav>

  </aside>

  <div class="sb-backdrop" id="sbBackdrop"></div>

  <!-- CONTENT -->
  <main class="content">
    <div class="topbar">
      <div class="d-flex align-items-center gap-2">
        <button class="sb-toggle" id="sbToggle">&#9776;</button>
        <h1><?= esc($title ?? 'Admin') ?></h1>
      </div>
      <div class="text-muted-2 small">Halo, <?= esc(session('admin_username') ?? 'Admin') ?> 👋</div>
    </div>

    <!-- Flash messages -->
    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <?= $this->renderSection('content') ?>
  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Sidebar toggle (mobile)
  const sb = document.getElementById('sidebar');
  const bd = document.getElementById('sbBackdrop');
  document.getElementById('sbToggle')?.addEventListener('click', () => { sb.classList.add('open'); bd.classList.add('show'); });
  bd?.addEventListener('click', () => { sb.classList.remove('open'); bd.classList.remove('show'); });
</script>
<?= $this->renderSection('scripts') ?>
</body>
</html>