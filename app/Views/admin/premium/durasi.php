<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="zp-card p-3 p-md-4">
  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h2 class="h5 mb-0">Durasi &amp; Harga</h2>
    <a href="<?= site_url('admin/premium/durasi/create') ?>" class="btn btn-accent btn-sm">+ Tambah Durasi</a>
  </div>
  <div class="table-responsive">
    <table class="table align-middle">
      <thead><tr><th>#</th><th>Produk</th><th>Durasi</th><th>Hari</th><th>Harga</th><th>Status</th><th class="text-end">Aksi</th></tr></thead>
      <tbody>
        <?php if (!empty($durasis)): foreach ($durasis as $i => $d): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><span class="badge badge-plat"><?= esc($d['produk_nama']) ?></span></td>
            <td><?= esc($d['label']) ?></td>
            <td class="text-muted-2"><?= $d['durasi_hari'] ?></td>
            <td>Rp <?= number_format($d['harga'], 0, ',', '.') ?></td>
            <td><span class="badge <?= $d['is_active'] ? 'badge-on' : 'badge-off' ?>"><?= $d['is_active'] ? 'Aktif' : 'Nonaktif' ?></span></td>
            <td class="text-end">
              <a href="<?= site_url('admin/premium/durasi/edit/'.$d['id']) ?>" class="btn btn-outline-accent btn-sm">Edit</a>
              <a href="<?= site_url('admin/premium/durasi/delete/'.$d['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Nonaktifkan durasi ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; else: ?>
          <tr><td colspan="7" class="text-center py-4 text-muted-2">Belum ada durasi.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>