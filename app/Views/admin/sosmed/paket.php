<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="zp-card p-3 p-md-4">
  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h2 class="h5 mb-0">Daftar Paket</h2>
    <a href="<?= site_url('admin/sosmed/paket/create') ?>" class="btn btn-accent btn-sm">+ Tambah Paket</a>
  </div>

  <div class="table-responsive">
    <table class="table align-middle">
      <thead><tr><th>#</th><th>Platform</th><th>Layanan</th><th>Jumlah</th><th>Harga</th><th>Status</th><th class="text-end">Aksi</th></tr></thead>
      <tbody>
        <?php if (!empty($pakets)): foreach ($pakets as $i => $p): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><span class="badge badge-plat"><?= esc($p['platform_nama']) ?></span></td>
            <td><?= esc($p['layanan_nama']) ?></td>
            <td><?= number_format($p['jumlah'], 0, ',', '.') ?></td>
            <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
            <td><span class="badge <?= $p['is_active'] ? 'badge-on' : 'badge-off' ?>"><?= $p['is_active'] ? 'Aktif' : 'Nonaktif' ?></span></td>
            <td class="text-end">
              <a href="<?= site_url('admin/sosmed/paket/edit/'.$p['id']) ?>" class="btn btn-outline-accent btn-sm">Edit</a>
              <a href="<?= site_url('admin/sosmed/paket/delete/'.$p['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Nonaktifkan paket ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; else: ?>
          <tr><td colspan="7" class="text-center py-4 text-muted-2">Belum ada paket.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>