<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="zp-card p-3 p-md-4">
  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h2 class="h5 mb-0">Daftar Platform</h2>
    <a href="<?= site_url('admin/sosmed/platform/create') ?>" class="btn btn-accent btn-sm">+ Tambah Platform</a>
  </div>

  <div class="table-responsive">
    <table class="table align-middle">
      <thead><tr><th>#</th><th>Nama</th><th>Slug</th><th>Status</th><th class="text-end">Aksi</th></tr></thead>
      <tbody>
        <?php if (!empty($platforms)): foreach ($platforms as $i => $p): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><?= esc($p['nama']) ?></td>
            <td><code class="text-muted-2"><?= esc($p['slug']) ?></code></td>
            <td><span class="badge <?= $p['is_active'] ? 'badge-on' : 'badge-off' ?>"><?= $p['is_active'] ? 'Aktif' : 'Nonaktif' ?></span></td>
            <td class="text-end">
              <a href="<?= site_url('admin/sosmed/platform/edit/'.$p['id']) ?>" class="btn btn-outline-accent btn-sm">Edit</a>
              <a href="<?= site_url('admin/sosmed/platform/delete/'.$p['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Nonaktifkan platform ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; else: ?>
          <tr><td colspan="5" class="text-center py-4 text-muted-2">Belum ada platform.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>