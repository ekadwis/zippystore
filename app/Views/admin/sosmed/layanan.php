<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="zp-card p-3 p-md-4">
  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h2 class="h5 mb-0">Daftar Layanan</h2>
    <a href="<?= site_url('admin/sosmed/layanan/create') ?>" class="btn btn-accent btn-sm">+ Tambah Layanan</a>
  </div>

  <div class="table-responsive">
    <table class="table align-middle">
      <thead><tr><th>#</th><th>Platform</th><th>Layanan</th><th>Min</th><th>Max</th><th>Status</th><th class="text-end">Aksi</th></tr></thead>
      <tbody>
        <?php if (!empty($layanans)): foreach ($layanans as $i => $l): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><span class="badge badge-plat"><?= esc($l['platform_nama']) ?></span></td>
            <td><?= esc($l['nama']) ?></td>
            <td><?= number_format($l['min_order'], 0, ',', '.') ?></td>
            <td><?= number_format($l['max_order'], 0, ',', '.') ?></td>
            <td><span class="badge <?= $l['is_active'] ? 'badge-on' : 'badge-off' ?>"><?= $l['is_active'] ? 'Aktif' : 'Nonaktif' ?></span></td>
            <td class="text-end">
              <a href="<?= site_url('admin/sosmed/layanan/edit/'.$l['id']) ?>" class="btn btn-outline-accent btn-sm">Edit</a>
              <a href="<?= site_url('admin/sosmed/layanan/delete/'.$l['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Nonaktifkan layanan ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; else: ?>
          <tr><td colspan="7" class="text-center py-4 text-muted-2">Belum ada layanan.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>