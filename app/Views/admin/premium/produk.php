<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="zp-card p-3 p-md-4">
  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h2 class="h5 mb-0">Daftar Produk Premium</h2>
    <a href="<?= site_url('admin/premium/produk/create') ?>" class="btn btn-accent btn-sm">+ Tambah Produk</a>
  </div>
  <div class="table-responsive">
    <table class="table align-middle">
      <thead><tr><th>#</th><th>Icon</th><th>Nama</th><th>Deskripsi</th><th>Status</th><th class="text-end">Aksi</th></tr></thead>
      <tbody>
        <?php if (!empty($produks)): foreach ($produks as $i => $p): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td style="font-size:22px"><?= esc($p['icon']) ?></td>
            <td><?= esc($p['nama']) ?></td>
            <td class="text-muted-2 small"><?= esc($p['deskripsi']) ?></td>
            <td><span class="badge <?= $p['is_active'] ? 'badge-on' : 'badge-off' ?>"><?= $p['is_active'] ? 'Aktif' : 'Nonaktif' ?></span></td>
            <td class="text-end">
              <a href="<?= site_url('admin/premium/produk/edit/'.$p['id']) ?>" class="btn btn-outline-accent btn-sm">Edit</a>
              <a href="<?= site_url('admin/premium/produk/delete/'.$p['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Nonaktifkan produk ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; else: ?>
          <tr><td colspan="6" class="text-center py-4 text-muted-2">Belum ada produk.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>