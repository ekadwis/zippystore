<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<!-- Sub-nav premium -->
<div class="d-flex gap-2 mb-4 flex-wrap">
  <a href="<?= site_url('admin/premium/produk') ?>" class="btn btn-outline-accent btn-sm">📦 Kelola Produk</a>
  <a href="<?= site_url('admin/premium/durasi') ?>" class="btn btn-outline-accent btn-sm">⏱️ Kelola Durasi & Harga</a>
</div>

<div class="zp-card p-3 p-md-4">
  <h2 class="h5 mb-3">Semua Paket Durasi Aktif</h2>
  <div class="table-responsive">
    <table class="table align-middle">
      <thead><tr><th>#</th><th>Produk</th><th>Durasi</th><th>Harga</th></tr></thead>
      <tbody>
        <?php if (!empty($durasis)): foreach ($durasis as $i => $d): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><span class="badge badge-plat"><?= esc($d['produk_nama']) ?></span></td>
            <td><?= esc($d['label']) ?></td>
            <td>Rp <?= number_format($d['harga'], 0, ',', '.') ?></td>
          </tr>
        <?php endforeach; else: ?>
          <tr><td colspan="4" class="text-center py-4 text-muted-2">Belum ada data.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>