<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<?php
  function admClientLogo($l) {
      if (empty($l)) return '';
      return (str_starts_with($l,'http://')||str_starts_with($l,'https://')) ? $l : base_url($l);
  }
?>
<div class="zp-card p-3 p-md-4">
  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h2 class="h5 mb-0">Daftar Client</h2>
    <a href="<?= site_url('admin/client/create') ?>" class="btn btn-accent btn-sm">+ Tambah Client</a>
  </div>
  <div class="table-responsive">
    <table class="table align-middle">
      <thead><tr><th>#</th><th>Logo</th><th>Nama</th><th>Deskripsi</th><th>Status</th><th class="text-end">Aksi</th></tr></thead>
      <tbody>
        <?php if (!empty($clients)): foreach ($clients as $i => $c): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td>
              <?php if (!empty($c['logo'])): ?>
                <img src="<?= esc(admClientLogo($c['logo']), 'attr') ?>" alt="" style="width:48px;height:48px;object-fit:contain;border-radius:6px;border:1px solid var(--zp-border)">
              <?php else: ?><span class="text-muted-2">—</span><?php endif; ?>
            </td>
            <td><?= esc($c['nama']) ?></td>
            <td class="text-muted-2 small"><?= esc($c['deskripsi']) ?></td>
            <td><span class="badge <?= $c['is_active'] ? 'badge-on' : 'badge-off' ?>"><?= $c['is_active'] ? 'Tampil' : 'Disembunyikan' ?></span></td>
            <td class="text-end">
              <a href="<?= site_url('admin/client/edit/'.$c['id']) ?>" class="btn btn-outline-accent btn-sm">Edit</a>
              <a href="<?= site_url('admin/client/delete/'.$c['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus client ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; else: ?>
          <tr><td colspan="6" class="text-center py-4 text-muted-2">Belum ada client.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>