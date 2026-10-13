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

  // Sample data tiket pesanan & joki terintegrasi
  $sampleOrders = [
    [
      'ticket_id' => '#ZP-JK-9041',
      'client' => 'Rian H. (Univ. Brawijaya)',
      'service' => 'Joki Debug Code Python (FastAPI & MySQL)',
      'pillar' => 'Asistensi IT & Joki',
      'pillar_class' => 'badge-status-joki',
      'nominal' => 175000,
      'status' => 'Dikerjakan (IT/Joki)',
      'status_class' => 'badge-status-joki',
      'time' => 'Deadline 6 Jam lagi'
    ],
    [
      'ticket_id' => '#ZP-PR-8820',
      'client' => 'Amanda Putri',
      'service' => 'Netflix Premium 4K UHD (Private 1 Bulan)',
      'pillar' => 'Aplikasi Premium',
      'pillar_class' => 'badge-status-selesai',
      'nominal' => 38000,
      'status' => 'Klaim Garansi (25–30 Hari)',
      'status_class' => 'badge-status-garansi',
      'time' => 'Masa Aktif s/d 28 Hari'
    ],
    [
      'ticket_id' => '#ZP-JK-9038',
      'client' => 'Bima Sakti',
      'service' => 'Olah Data Statistik SPSS & Excel Pivot',
      'pillar' => 'Asistensi IT & Joki',
      'pillar_class' => 'badge-status-joki',
      'nominal' => 120000,
      'status' => 'Revisi',
      'status_class' => 'badge-status-revisi',
      'time' => 'Revisi Minor #1'
    ],
    [
      'ticket_id' => '#ZP-SM-7714',
      'client' => 'Creative Hub ID',
      'service' => 'SMM Boost Instagram 5.000 Follower HQ',
      'pillar' => 'Kebutuhan Sosmed',
      'pillar_class' => 'badge-plat',
      'nominal' => 110000,
      'status' => 'Belum Diproses',
      'status_class' => 'badge-status-pending',
      'time' => 'Order Masuk 20m lalu'
    ],
    [
      'ticket_id' => '#ZP-PR-8815',
      'client' => 'Dimas Arya',
      'service' => 'Spotify Premium Individual (3 Bulan)',
      'pillar' => 'Aplikasi Premium',
      'pillar_class' => 'badge-status-selesai',
      'nominal' => 32000,
      'status' => 'Selesai',
      'status_class' => 'badge-status-selesai',
      'time' => 'Transaksi Sukses'
    ]
  ];
?>

<!-- 1. STAT CARDS & METRIK RINGKAS (NEO-BRUTALIST CHUNKY POP) -->
<div class="row g-3 mb-4">
  <!-- Card 1: Total Order -->
  <div class="col-6 col-xl-3">
    <div class="stat stat-cat-omzet">
      <div class="d-flex justify-content-between align-items-center mb-1">
        <span class="lbl">TOTAL ORDER</span>
        <span style="font-size: 1.25rem;">📦</span>
      </div>
      <div class="num">1.482+</div>
      <small class="text-muted fw-bold">Sejak 2019 • Transparan</small>
    </div>
  </div>

  <!-- Card 2: Omzet Bulanan -->
  <div class="col-6 col-xl-3">
    <div class="stat stat-cat-omzet">
      <div class="d-flex justify-content-between align-items-center mb-1">
        <span class="lbl">OMZET BULANAN</span>
        <span style="font-size: 1.25rem;">💳</span>
      </div>
      <div class="num" style="font-size: 1.55rem;">Rp 14,8 Jt</div>
      <small class="text-muted fw-bold">Metode Utama QRIS &amp; Bank</small>
    </div>
  </div>

  <!-- Card 3: Tiket Joki Aktif (Amber) -->
  <div class="col-6 col-xl-3">
    <div class="stat stat-cat-joki">
      <div class="d-flex justify-content-between align-items-center mb-1">
        <span class="lbl">TIKET JOKI AKTIF</span>
        <span style="font-size: 1.25rem;">💻</span>
      </div>
      <div class="num" style="color: #b45309;">8 Antrean</div>
      <small class="text-muted fw-bold">IT Coding &amp; Olah Data</small>
    </div>
  </div>

  <!-- Card 4: Klaim Garansi Akun (Mint) -->
  <div class="col-6 col-xl-3">
    <div class="stat stat-cat-app">
      <div class="d-flex justify-content-between align-items-center mb-1">
        <span class="lbl">GARANSI AKUN AKTIF</span>
        <span style="font-size: 1.25rem;">🛡️</span>
      </div>
      <div class="num" style="color: #047857;">25–30 Hari</div>
      <small class="text-muted fw-bold">2 Tiket Dipantau Admin</small>
    </div>
  </div>
</div>

<!-- QUICK ACTION BAR -->
<div class="zp-card p-3 mb-4" style="background: #fef08a;">
  <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
    <div class="d-flex align-items-center gap-2">
      <span class="badge" style="background:#ef4444; color:#fff; border-color:#18181b;">FLASH SALE AKTIF</span>
      <span class="fw-bold small">Jumbotron promo sedang tayang di domain resmi <strong>zippystore.my.id</strong></span>
    </div>
    <div class="d-flex gap-2 flex-wrap">
      <a href="<?= site_url('admin/flash-sale') ?>" class="btn btn-sm btn-accent">⚡ Kelola Flash Sale</a>
      <a href="<?= site_url('admin/sosmed/kalkulator') ?>" class="btn btn-sm btn-outline-accent">🧮 Buka Kalkulator</a>
      <a href="<?= site_url('/') ?>" target="_blank" class="btn btn-sm btn-outline-accent">🏠 Lihat Web</a>
    </div>
  </div>
</div>

<!-- 2. TABEL MANAJEMEN PESANAN & TIKET JOKI -->
<div class="zp-card p-3 p-md-4 mb-4">
  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
      <h2 class="h5 mb-1">📋 Manajemen Pesanan, Tiket Joki, &amp; Layanan</h2>
      <p class="text-muted small mb-0">Pantau status pengerjaan, deadline tugas, dan jaminan after-sales garansi.</p>
    </div>
    <div class="d-flex gap-2">
      <span class="badge badge-status-joki">Dikerjakan: 1</span>
      <span class="badge badge-status-garansi">Garansi: 1</span>
      <span class="badge badge-status-revisi">Revisi: 1</span>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table align-middle">
      <thead>
        <tr>
          <th>ID Slip</th>
          <th>Klien &amp; Instansi</th>
          <th>Layanan Terpesan</th>
          <th>Nominal</th>
          <th>Catatan Waktu</th>
          <th>Status Pengerjaan</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($sampleOrders as $o): ?>
          <tr>
            <td>
              <strong style="font-family:monospace;"><?= esc($o['ticket_id']) ?></strong>
            </td>
            <td>
              <div class="fw-bold"><?= esc($o['client']) ?></div>
            </td>
            <td>
              <div class="fw-semibold"><?= esc($o['service']) ?></div>
              <small class="badge <?= esc($o['pillar_class']) ?>" style="font-size:10px; padding:2px 8px;"><?= esc($o['pillar']) ?></small>
            </td>
            <td>
              <strong>Rp <?= number_format($o['nominal'], 0, ',', '.') ?></strong>
            </td>
            <td>
              <small class="text-muted fw-bold"><?= esc($o['time']) ?></small>
            </td>
            <td>
              <span class="badge <?= esc($o['status_class']) ?>">
                <?= esc($o['status']) ?>
              </span>
            </td>
            <td class="text-end">
              <button type="button" class="btn btn-sm btn-outline-accent" onclick="alert('Tiket <?= esc($o['ticket_id']) ?>: Detail & update status WhatsApp siap dihubungi!')">
                Detail
              </button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- 3. TABEL KATALOG PAKET AKTIF -->
<div class="zp-card p-3 p-md-4">
  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
      <h2 class="h5 mb-1">📦 Daftar Paket Sosmed Aktif</h2>
      <p class="text-muted small mb-0">Total <?= $totalPaket ?> paket dari <?= count($platSet) ?> platform terdaftar.</p>
    </div>
    <a href="<?= site_url('admin/sosmed/paket/create') ?>" class="btn btn-accent btn-sm">+ Tambah Paket Baru</a>
  </div>

  <?php if (!empty($pakets)): ?>
    <div class="table-responsive">
      <table class="table align-middle">
        <thead>
          <tr>
            <th>#</th>
            <th>Platform</th>
            <th>Layanan</th>
            <th>Jumlah Satuan</th>
            <th>Harga Resmi</th>
            <th class="text-end">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pakets as $i => $p): ?>
            <tr>
              <td><?= $i + 1 ?></td>
              <td><span class="badge badge-plat"><?= esc($p['platform_nama']) ?></span></td>
              <td><strong><?= esc($p['layanan_nama']) ?></strong></td>
              <td><?= number_format($p['jumlah'], 0, ',', '.') ?></td>
              <td><span class="fw-bold" style="color:#047857;">Rp <?= number_format($p['harga'], 0, ',', '.') ?></span></td>
              <td class="text-end">
                <a href="<?= site_url('admin/sosmed/paket/edit/' . $p['id']) ?>" class="btn btn-sm btn-outline-accent">Edit</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="text-center py-5 text-muted-2">
      Belum ada paket. <a href="<?= site_url('admin/sosmed/paket/create') ?>" class="fw-bold text-decoration-underline">Tambah sekarang</a>.
    </div>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>