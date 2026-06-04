<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="zp-card p-3 p-md-4">
  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h2 class="h5 mb-0">Daftar Promo</h2>
    <a href="<?= site_url('admin/promo/create') ?>" class="btn btn-accent btn-sm">+ Tambah Promo</a>
  </div>
  <div class="table-responsive">
    <table class="table align-middle">
      <thead><tr><th>#</th><th>Kode</th><th>Diskon</th><th>Deskripsi</th><th>Berlaku s/d</th><th>Status</th><th class="text-end">Aksi</th></tr></thead>
      <tbody>
        <?php if (!empty($promos)): foreach ($promos as $i => $p): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><code class="text-grad"><?= esc($p['kode']) ?></code></td>
            <td><?= (int)$p['diskon'] ?>%</td>
            <td class="text-muted-2 small"><?= esc($p['deskripsi']) ?></td>
            <td class="small"><?= !empty($p['valid_until']) ? date('d M Y', strtotime($p['valid_until'])) : '-' ?></td>
            <td><span class="badge <?= $p['is_active'] ? 'badge-on' : 'badge-off' ?>"><?= $p['is_active'] ? 'Aktif' : 'Nonaktif' ?></span></td>
            <td class="text-end">
              <a href="<?= site_url('admin/promo/edit/'.$p['id']) ?>" class="btn btn-outline-accent btn-sm">Edit</a>
              <a href="<?= site_url('admin/promo/delete/'.$p['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus promo ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; else: ?>
          <tr><td colspan="7" class="text-center py-4 text-muted-2">Belum ada promo.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>