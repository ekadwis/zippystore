<?= $this->include('template/header') ?>

<?php
$waNumber = $waNumber ?? '6285177838705';
$defaultProduk = [
  [
    'produk' => ['icon' => '🎬', 'nama' => 'Netflix Premium UHD 4K', 'deskripsi' => 'Resolusi 4K Ultra HD, profile tersendiri dengan PIN pribadi, anti on-hold.'],
    'durasi' => [
      ['label' => '1P1U 7 Hari (🔥 Promo Minggu Ini)', 'harga' => 9000],
      ['label' => '1 Bulan - 1 Device Sharing', 'harga' => 30000],
      ['label' => '1 Bulan - Private Profile', 'harga' => 38000],
    ]
  ],
  [
    'produk' => ['icon' => '🎨', 'nama' => 'Canva Pro', 'deskripsi' => 'Aplikasi desain grafis terlengkap: template pro, jutaan aset, background remover.'],
    'durasi' => [
      ['label' => '3 Bulan (🔥 Promo Oktober)', 'harga' => 5000],
      ['label' => '12 Bulan / 1 Tahun (🔥 Promo Oktober)', 'harga' => 15000],
    ]
  ],
  [
    'produk' => ['icon' => '🤖', 'nama' => 'Gemini PRO', 'deskripsi' => 'Model AI cerdas Google untuk coding, riset, olah dokumen, dan penalaran tingkat lanjut.'],
    'durasi' => [
      ['label' => '6 Bulan (🔥 Promo Oktober)', 'harga' => 50000],
    ]
  ],
  [
    'produk' => ['icon' => '🎵', 'nama' => 'Spotify Premium', 'deskripsi' => 'Bebas iklan, download offline, kualitas audio tertinggi.'],
    'durasi' => [
      ['label' => '1 Bulan (Garansi 25-30 Hari)', 'harga' => 20000],
      ['label' => '3 Bulan (Garansi Penuh)', 'harga' => 50000],
    ]
  ],
  [
    'produk' => ['icon' => '▶️', 'nama' => 'YouTube Premium', 'deskripsi' => 'Bebas iklan, background play, termasuk akses YouTube Music.'],
    'durasi' => [
      ['label' => '1 Bulan (Garansi 25-30 Hari)', 'harga' => 15000],
      ['label' => '3 Bulan (Garansi Penuh)', 'harga' => 35000],
    ]
  ],
  [
    'produk' => ['icon' => '✂️', 'nama' => 'CapCut Pro', 'deskripsi' => 'Buka semua fitur pro, efek eksklusif, template viral & cloud storage.'],
    'durasi' => [
      ['label' => '1 Bulan (Garansi 25-30 Hari)', 'harga' => 25000],
      ['label' => '1 Tahun Akun Pro', 'harga' => 90000],
    ]
  ],
];

$itemsRender = !empty($struktur) ? $struktur : $defaultProduk;
?>

<header class="section text-center" style="padding-top:140px;padding-bottom:30px">
  <div class="container">
    <div class="d-inline-flex align-items-center gap-2 mb-3 reveal">
      <span class="badge-app">AKUN LEGAL &amp; RESMI</span>
      <span class="badge-trust">🛡️ Garansi 25–30 Hari Penuh</span>
    </div>
    <h1 class="fw-bold reveal">
      Akun &amp; Aplikasi <span class="text-grad-blue">Premium Bergaransi</span>
    </h1>
    <p class="text-muted-2 reveal mx-auto" style="max-width:640px">
      Akses streaming musik, film, dan tools produktivitas legal dari supplier tangan pertama (*first-hand*). Harga mahasiswa dengan perlindungan garansi nyata.
    </p>
  </div>
</header>

<!-- JUMBOTRON FLASH SALE BANNER -->
<?= $this->include('components/flash_sale_banner') ?>

<!-- TRUST BAR KHUSUS PREMIUM (CHUNKY TILES) -->
<section class="pt-0 pb-4">
  <div class="container">
    <div class="row g-3">
      <div class="col-6 col-md-3 reveal">
        <div class="zp-card p-3 text-center" style="background:#ecfdf5">
          <div style="font-size:26px;margin-bottom:6px">🛡️</div>
          <h6 class="mb-1 fw-bold" style="font-size:14px">Garansi 25–30 Hari</h6>
          <p class="text-muted-2 mb-0" style="font-size:12px">Paket bulanan bergaransi penuh</p>
        </div>
      </div>
      <div class="col-6 col-md-3 reveal">
        <div class="zp-card p-3 text-center" style="background:#ecfdf5">
          <div style="font-size:26px;margin-bottom:6px">⚡</div>
          <h6 class="mb-1 fw-bold" style="font-size:14px">Supplier First-Hand</h6>
          <p class="text-muted-2 mb-0" style="font-size:12px">Jalur tangan pertama terverifikasi</p>
        </div>
      </div>
      <div class="col-6 col-md-3 reveal">
        <div class="zp-card p-3 text-center" style="background:#ecfdf5">
          <div style="font-size:26px;margin-bottom:6px">📱</div>
          <h6 class="mb-1 fw-bold" style="font-size:14px">Klaim Mudah &amp; Cepat</h6>
          <p class="text-muted-2 mb-0" style="font-size:12px">Cukup screenshot bukti kendala</p>
        </div>
      </div>
      <div class="col-6 col-md-3 reveal">
        <div class="zp-card p-3 text-center" style="background:#ecfdf5">
          <div style="font-size:26px;margin-bottom:6px">💳</div>
          <h6 class="mb-1 fw-bold" style="font-size:14px">Instant QRIS</h6>
          <p class="text-muted-2 mb-0" style="font-size:12px">Semua E-Wallet &amp; M-Banking</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- KATALOG PRODUK PREMIUM: FORMAT ORDER SLIP -->
<section class="section pt-3">
  <div class="container">
    <div class="row g-4">
      <?php foreach ($itemsRender as $idx => $blok): ?>
        <div class="col-12 col-md-6 col-lg-6 reveal">
          <div class="ticket-slip ticket-app">
            <div class="ticket-header">
              <div class="d-flex align-items-center gap-2">
                <span style="font-size:24px"><?= esc($blok['produk']['icon']) ?></span>
                <span class="badge-app"><?= esc($blok['produk']['nama']) ?></span>
              </div>
              <span class="ticket-id">SLIP #APP-<?= ($idx + 1) ?></span>
            </div>

            <div class="ticket-body">
              <?php if (!empty($blok['produk']['deskripsi'])): ?>
                <p class="text-muted-2 small mb-3"><?= esc($blok['produk']['deskripsi']) ?></p>
              <?php endif; ?>

              <div class="mb-2">
                <span class="badge-trust" style="font-size:11px;background:#ecfdf5">PILIHAN DURASI &amp; TARIF RESMI:</span>
              </div>

              <ul class="list-unstyled mb-0">
                <?php foreach ($blok['durasi'] as $d): ?>
                  <?php
                    $teks = $blok['produk']['nama'] . ' - ' . $d['label'];
                    $pesan = "Halo Zippy Store, saya mau pesan Akun Premium:%0A" .
                             "*" . rawurlencode($teks) . "*%0A" .
                             "Harga: Rp " . number_format($d['harga'], 0, ',', '.') . "%0A%0A" .
                             "Mohon info rekening/QRIS untuk pembayarannya. Terima kasih!";
                    $waLink = "https://wa.me/{$waNumber}?text={$pesan}";
                  ?>
                  <li class="price-item-row">
                    <span class="small fw-bold">
                      <?= esc($d['label']) ?>
                    </span>
                    <span class="d-flex align-items-center gap-2">
                      <span class="fw-bold" style="font-family:var(--font-display);font-size:15px">
                        Rp <?= number_format($d['harga'], 0, ',', '.') ?>
                      </span>
                      <a href="<?= $waLink ?>" target="_blank" rel="noopener" class="btn btn-sm btn-accent py-1 px-3" style="background:var(--accent-app);font-size:12px">
                        Order
                      </a>
                    </span>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>

            <div class="ticket-perforated">
              <div class="ticket-notch-left"></div>
              <div class="ticket-notch-right"></div>
              <span class="small fw-bold text-muted-2">
                🛡️ Dilindungi garansi aktif 25–30 hari. Klaim instan via admin WhatsApp.
              </span>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- SOP KLAIM GARANSI & REGULASI RESMI -->
<section class="section pt-0">
  <div class="container">
    <div class="ticket-slip ticket-app p-0 reveal">
      <div class="ticket-header">
        <h2 class="h5 mb-0 fw-bold">📋 SOP &amp; Kebijakan Garansi After-Sales</h2>
        <span class="ticket-id">KEBIJAKAN RESMI</span>
      </div>

      <div class="p-4 p-md-5">
        <p class="text-muted-2 small mb-4">
          Zippy Store berkomitmen memberikan kenyamanan dan transparansi kepada setiap pembeli. Berikut ketentuan resmi kami:
        </p>

        <ul class="ketentuan-list">
          <?php foreach ($regulasi as $r): ?>
            <li>
              <span class="k-ico" style="background:var(--accent-app)">✓</span>
              <span><?= esc($r) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>

        <!-- 3 Langkah Klaim Garansi -->
        <div class="mt-4 pt-4 border-top" style="border-color:var(--zp-border-solid)!important">
          <h3 class="h6 fw-bold mb-3">Cara Cepat Klaim Garansi:</h3>
          <div class="row g-3">
            <div class="col-md-4">
              <div class="p-3 zp-card" style="background:#ecfdf5">
                <span class="badge-app mb-2 d-inline-block">Langkah 1</span>
                <h6 class="fw-bold small mb-1">Ambil Screenshot</h6>
                <p class="text-muted-2 mb-0" style="font-size:12px">Tangkap layar bukti pesan error atau kendala saat login akun.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="p-3 zp-card" style="background:#ecfdf5">
                <span class="badge-app mb-2 d-inline-block">Langkah 2</span>
                <h6 class="fw-bold small mb-1">Kirim ke WhatsApp</h6>
                <p class="text-muted-2 mb-0" style="font-size:12px">Kirimkan screenshot dan tanggal order kepada admin kami.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="p-3 zp-card" style="background:#ecfdf5">
                <span class="badge-app mb-2 d-inline-block">Langkah 3</span>
                <h6 class="fw-bold small mb-1">Perbaikan / Penggantian</h6>
                <p class="text-muted-2 mb-0" style="font-size:12px">Admin memproses ke supplier first-hand untuk perbaikan atau penyerahan akun baru.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->include('template/footer') ?>