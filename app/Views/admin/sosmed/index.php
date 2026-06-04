<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<?php
  // Hitung statistik ringkas
  $totalPaket = count($pakets);
  $platSet = []; $layananSet = [];
  foreach ($pakets as $p) { $platSet[$p['platform_nama']] = true; $layananSet[$p['layanan_nama'].$p['platform_nama']] = true; }
?>

<div class="row g-3 mb-4">
  <div class="col-6 col-lg-3"><div class="stat"><div class="num text-grad" style="color:var(--zp-accent-2)"><?= $totalPaket ?></div><div class="lbl">Total Paket Aktif</div></div></div>
  <div class="col-6 col-lg-3"><div class="stat"><div class="num"><?= count($platSet) ?></div><div class="lbl">Platform</div></div></div>
  <div class="col-6 col-lg-3"><div class="stat"><div class="num"><?= count($layananSet) ?></div><div class="lbl">Kombinasi Layanan</div></div></div>
  <div class="col-6 col-lg-3"><div class="stat"><a href="<?= site_url('admin/sosmed/kalkulator') ?>" class="btn btn-accent w-100 mt-2">🧮 Buka Kalkulator</a></div></div>
</div>

<div class="zp-card p-3 p-md-4">
  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h2 class="h5 mb-0">Daftar Paket Aktif</h2>
    <a href="<?= site_url('admin/sosmed/paket/create') ?>" class="btn btn-accent btn-sm">+ Tambah Paket</a>
  </div>

  <?php if (!empty($pakets)): ?>
    <div class="table-responsive">
      <table class="table align-middle">
        <thead><tr><th>#</th><th>Platform</th><th>Layanan</th><th>Jumlah</th><th>Harga</th></tr></thead>
        <tbody>
          <?php foreach ($pakets as $i => $p): ?>
            <tr>
              <td><?= $i + 1 ?></td>
              <td><span class="badge badge-plat"><?= esc($p['platform_nama']) ?></span></td>
              <td><?= esc($p['layanan_nama']) ?></td>
              <td><?= number_format($p['jumlah'], 0, ',', '.') ?></td>
              <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="text-center py-5 text-muted-2">Belum ada paket. <a href="<?= site_url('admin/sosmed/paket/create') ?>" class="text-grad">Tambah sekarang</a>.</div>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>