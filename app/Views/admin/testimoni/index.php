<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<?php
  function admTestiSrc($g) {
      if (empty($g)) return '';
      return (str_starts_with($g, 'http://') || str_starts_with($g, 'https://')) ? $g : base_url($g);
  }
?>

<div class="zp-card p-3 p-md-4">
  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h2 class="h5 mb-0">Daftar Testimoni</h2>
    <a href="<?= site_url('admin/testimoni/create') ?>" class="btn btn-accent btn-sm">+ Tambah Testimoni</a>
  </div>

  <div class="table-responsive">
    <table class="table align-middle">
      <thead>
        <tr><th>#</th><th>Foto</th><th>Nama</th><th>Tanggal</th><th>Status</th><th class="text-end">Aksi</th></tr>
      </thead>
      <tbody>
        <?php if (!empty($testimonis)): foreach ($testimonis as $i => $t): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td>
              <img src="<?= esc(admTestiSrc($t['gambar']), 'attr') ?>" alt="" 
                   style="width:42px;height:64px;object-fit:cover;border-radius:6px;border:1px solid var(--zp-border)">
            </td>
            <td>
              <?= esc($t['nama']) ?>
              <?php if (!empty($t['isi'])): ?>
                <div class="text-muted-2" style="font-size:12px;max-width:280px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?= esc($t['isi']) ?></div>
              <?php endif; ?>
            </td>
            <td class="small"><?= !empty($t['tanggal']) ? date('d M Y', strtotime($t['tanggal'])) : '-' ?></td>
            <td><span class="badge <?= $t['is_active'] ? 'badge-on' : 'badge-off' ?>"><?= $t['is_active'] ? 'Tampil' : 'Disembunyikan' ?></span></td>
            <td class="text-end">
              <a href="<?= site_url('admin/testimoni/edit/'.$t['id']) ?>" class="btn btn-outline-accent btn-sm">Edit</a>
              <a href="<?= site_url('admin/testimoni/toggle/'.$t['id']) ?>" class="btn btn-sm btn-outline-light"><?= $t['is_active'] ? 'Sembunyikan' : 'Tampilkan' ?></a>
              <a href="<?= site_url('admin/testimoni/delete/'.$t['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus permanen testimoni ini? Tindakan tidak bisa dibatalkan.')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; else: ?>
          <tr><td colspan="6" class="text-center py-4 text-muted-2">Belum ada testimoni. <a href="<?= site_url('admin/testimoni/create') ?>" class="text-grad">Tambah sekarang</a>.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>