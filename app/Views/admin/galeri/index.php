<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<?php
  function admGalSrc($f) {
      if (empty($f)) return '';
      return (str_starts_with($f, 'http://') || str_starts_with($f, 'https://')) ? $f : base_url($f);
  }
  $katBadge = ['surat'=>'Surat','tugas'=>'Tugas','premium'=>'Premium','sosmed'=>'Sosmed'];
?>

<div class="zp-card p-3 p-md-4">
  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h2 class="h5 mb-0">Daftar Gambar Galeri</h2>
    <a href="<?= site_url('admin/galeri/create') ?>" class="btn btn-accent btn-sm">+ Tambah Gambar</a>
  </div>

  <div class="table-responsive">
    <table class="table align-middle">
      <thead>
        <tr><th>#</th><th>Gambar</th><th>Nama</th><th>Kategori</th><th>Status</th><th class="text-end">Aksi</th></tr>
      </thead>
      <tbody>
        <?php if (!empty($galeris)): foreach ($galeris as $i => $g): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td>
              <img src="<?= esc(admGalSrc($g['file']), 'attr') ?>" alt=""
                   style="width:70px;height:50px;object-fit:cover;border-radius:6px;border:1px solid var(--zp-border)">
            </td>
            <td><?= esc($g['nama']) ?></td>
            <td><span class="badge badge-plat"><?= esc($katBadge[$g['kategori']] ?? ucfirst($g['kategori'])) ?></span></td>
            <td><span class="badge <?= $g['is_active'] ? 'badge-on' : 'badge-off' ?>"><?= $g['is_active'] ? 'Tampil' : 'Disembunyikan' ?></span></td>
            <td class="text-end">
              <a href="<?= site_url('admin/galeri/edit/'.$g['id']) ?>" class="btn btn-outline-accent btn-sm">Edit</a>
              <a href="<?= site_url('admin/galeri/toggle/'.$g['id']) ?>" class="btn btn-sm btn-outline-light"><?= $g['is_active'] ? 'Sembunyikan' : 'Tampilkan' ?></a>
              <a href="<?= site_url('admin/galeri/delete/'.$g['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus permanen gambar ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; else: ?>
          <tr><td colspan="6" class="text-center py-4 text-muted-2">Belum ada gambar. <a href="<?= site_url('admin/galeri/create') ?>" class="text-grad">Tambah sekarang</a>.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>