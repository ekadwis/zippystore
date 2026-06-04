<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="zp-card p-3 p-md-4">
  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h2 class="h5 mb-0">Statistik / Pencapaian</h2>
    <a href="<?= site_url('admin/statistik/create') ?>" class="btn btn-accent btn-sm">+ Tambah Statistik</a>
  </div>
  <div class="table-responsive">
    <table class="table align-middle">
      <thead><tr><th>#</th><th>Icon</th><th>Angka</th><th>Label</th><th>Urutan</th><th>Status</th><th class="text-end">Aksi</th></tr></thead>
      <tbody>
        <?php if (!empty($statistik)): foreach ($statistik as $i => $s): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td style="font-size:22px"><?= esc($s['icon']) ?></td>
            <td class="fw-bold text-grad"><?= esc($s['angka']) ?></td>
            <td><?= esc($s['label']) ?></td>
            <td class="text-muted-2"><?= $s['urutan'] ?></td>
            <td><span class="badge <?= $s['is_active'] ? 'badge-on' : 'badge-off' ?>"><?= $s['is_active'] ? 'Tampil' : 'Disembunyikan' ?></span></td>
            <td class="text-end">
              <a href="<?= site_url('admin/statistik/edit/'.$s['id']) ?>" class="btn btn-outline-accent btn-sm">Edit</a>
              <a href="<?= site_url('admin/statistik/delete/'.$s['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus statistik ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; else: ?>
          <tr><td colspan="7" class="text-center py-4 text-muted-2">Belum ada statistik.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>