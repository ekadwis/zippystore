<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<?php
  // Hitung statistik ringkas paket
  $totalPaket = count($pakets ?? []);
  $platSet = []; $layananSet = [];
  foreach (($pakets ?? []) as $p) { 
    $platSet[$p['platform_nama']] = true; 
    $layananSet[$p['layanan_nama'].$p['platform_nama']] = true; 
  }
?>

<!-- 1. STAT CARDS & METRIK RINGKAS -->
<div class="row g-3 mb-4">
  <div class="col-6 col-xl-3">
    <div class="stat stat-cat-omzet">
      <div class="d-flex justify-content-between align-items-center mb-1">
        <span class="lbl">TOTAL ORDER SMM</span>
        <span style="font-size: 1.25rem;">📦</span>
      </div>
      <div class="val text-dark"><?= number_format($totalOrdersCount ?? 0) ?></div>
      <div class="badge-trend trend-neutral mt-2">
        <span>⚡ Auto Dispatch API</span>
      </div>
    </div>
  </div>

  <div class="col-6 col-xl-3">
    <div class="stat stat-cat-volume">
      <div class="d-flex justify-content-between align-items-center mb-1">
        <span class="lbl">SALDO SPRINTPEDIA</span>
        <span style="font-size: 1.25rem;">💳</span>
      </div>
      <div class="val text-primary" style="font-size:1.4rem">
        <?= !empty($sprintpediaBalance) ? 'Rp ' . number_format((float)$sprintpediaBalance, 0, ',', '.') : 'Terkoneksi' ?>
      </div>
      <div class="badge-trend trend-up mt-2">
        <span>● Server Live &amp; Ready</span>
      </div>
    </div>
  </div>

  <div class="col-6 col-xl-3">
    <div class="stat stat-cat-layanan">
      <div class="d-flex justify-content-between align-items-center mb-1">
        <span class="lbl">LAYANAN AKTIF</span>
        <span style="font-size: 1.25rem;">🛠️</span>
      </div>
      <div class="val text-dark"><?= count($layananSet) ?> <small style="font-size:0.9rem;font-weight:600">Layanan</small></div>
      <div class="badge-trend trend-up mt-2">
        <span><?= count($platSet) ?> Platform (IG &amp; TT)</span>
      </div>
    </div>
  </div>

  <div class="col-6 col-xl-3">
    <div class="stat stat-cat-garansi">
      <div class="d-flex justify-content-between align-items-center mb-1">
        <span class="lbl">PAKET TERSEDIA</span>
        <span style="font-size: 1.25rem;">🏷️</span>
      </div>
      <div class="val text-dark"><?= $totalPaket ?> <small style="font-size:0.9rem;font-weight:600">Paket</small></div>
      <div class="badge-trend trend-up mt-2">
        <span>Tersedia LQ, HQ &amp; Views</span>
      </div>
    </div>
  </div>
</div>

<!-- 2. RIWAYAT PESANAN REALTIME (AUTO ORDERS) -->
<div class="card neo-card mb-4">
  <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
    <div>
      <h5 class="mb-0 fw-bold">📋 Riwayat Pesanan Otomatis (Sosmed SMM)</h5>
      <small class="text-muted">Data pesanan pembeli yang langsung terhubung ke Sprintpedia API</small>
    </div>
    <span class="badge bg-success px-3 py-2 text-white">Realtime Database</span>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>Kode Order</th>
            <th>Layanan</th>
            <th>Target Link / Username</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Sprintpedia ID</th>
            <th>Status</th>
            <th>Waktu</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($orders)): ?>
            <?php foreach ($orders as $ord): ?>
              <tr>
                <td>
                  <span class="font-monospace fw-bold text-dark"><?= esc($ord['order_code']) ?></span>
                  <?php if (!empty($ord['wa_buyer'])): ?>
                    <br><small class="text-muted"><i class="fab fa-whatsapp text-success"></i> <?= esc($ord['wa_buyer']) ?></small>
                  <?php endif; ?>
                </td>
                <td>
                  <span class="badge bg-light text-dark border"><?= esc($ord['platform_nama']) ?></span>
                  <strong><?= esc($ord['layanan_nama']) ?></strong>
                </td>
                <td style="max-width:240px">
                  <span class="text-break small"><?= esc($ord['target']) ?></span>
                </td>
                <td><strong><?= number_format($ord['jumlah'], 0, ',', '.') ?></strong></td>
                <td><span class="text-success fw-bold">Rp <?= number_format($ord['harga'], 0, ',', '.') ?></span></td>
                <td>
                  <?php if (!empty($ord['provider_order_id'])): ?>
                    <span class="badge bg-primary font-monospace">#<?= esc($ord['provider_order_id']) ?></span>
                  <?php else: ?>
                    <span class="badge bg-danger">Failed / No ID</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php 
                    $badgeClass = 'bg-secondary';
                    if ($ord['status_order'] === 'processing') $badgeClass = 'bg-warning text-dark';
                    if ($ord['status_order'] === 'completed')  $badgeClass = 'bg-success';
                    if ($ord['status_order'] === 'failed')     $badgeClass = 'bg-danger';
                  ?>
                  <span class="badge <?= $badgeClass ?>"><?= strtoupper($ord['status_order']) ?></span>
                </td>
                <td>
                  <small class="text-muted"><?= date('d M Y, H:i', strtotime($ord['created_at'])) ?></small>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="8" class="text-center py-4 text-muted">Belum ada pesanan otomatis yang tercatat.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- 3. LIST DAFTAR PAKET AKTIF -->
<div class="card neo-card">
  <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
    <h5 class="mb-0 fw-bold">🏷️ Konfigurasi Paket &amp; Harga Saat Ini</h5>
    <div class="d-flex gap-2">
      <a href="<?= base_url('admin/sosmed/layanan') ?>" class="btn btn-sm btn-outline-dark">Kelola Layanan (Service ID)</a>
      <a href="<?= base_url('admin/sosmed/paket/create') ?>" class="btn btn-sm btn-dark">+ Tambah Paket</a>
    </div>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>Platform</th>
            <th>Nama Layanan</th>
            <th>Service ID API</th>
            <th>Jumlah</th>
            <th>Harga Jual</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($pakets)): ?>
            <?php foreach ($pakets as $p): ?>
              <tr>
                <td><span class="badge bg-info text-dark"><?= esc($p['platform_nama']) ?></span></td>
                <td><strong><?= esc($p['layanan_nama']) ?></strong></td>
                <td>
                  <span class="badge bg-light text-dark border font-monospace">
                    <?= !empty($p['provider_service_id']) ? esc($p['provider_service_id']) : '-' ?>
                  </span>
                </td>
                <td><?= number_format($p['jumlah'], 0, ',', '.') ?> pcs</td>
                <td><strong class="text-success">Rp <?= number_format($p['harga'], 0, ',', '.') ?></strong></td>
                <td>
                  <a href="<?= base_url('admin/sosmed/paket/edit/' . $p['id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                  <a href="<?= base_url('admin/sosmed/paket/delete/' . $p['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus paket ini?')">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
