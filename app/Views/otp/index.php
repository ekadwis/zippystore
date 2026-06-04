<?= $this->include('template/header') ?>

<?php $waNumber = $waNumber ?? '6285177838705'; ?>

<header class="section text-center" style="padding-top:140px">
  <div class="container">
    <h1 class="fw-bold reveal">Nomor <span class="text-grad">OTP</span></h1>
    <p class="text-muted-2 reveal mx-auto" style="max-width:620px">
      Sewa nomor untuk verifikasi OTP berbagai aplikasi. Sekali pakai, strong number, proses cepat.
    </p>
  </div>
</header>

<section class="section pt-0">
  <div class="container">
    <div class="row g-4">

      <!-- LIST PRODUK -->
      <div class="col-12 col-lg-7">
        <div class="zp-card p-4 reveal">
          <h2 class="h5 mb-3">Daftar Harga</h2>
          <?php if (!empty($produks)): ?>
            <ul class="list-unstyled mb-0">
              <?php foreach ($produks as $p): ?>
                <?php
                  $teks = 'Nomor OTP ' . $p['nama'];
                  $pesan = "Halo Zippy Store, saya mau order:%0A" .
                           "*" . rawurlencode($teks) . "*%0A" .
                           "Harga: Rp " . number_format($p['harga'], 0, ',', '.');
                  $waLink = "https://wa.me/{$waNumber}?text={$pesan}";
                ?>
                <li class="d-flex justify-content-between align-items-center py-3" style="border-bottom:1px solid var(--border)">
                  <span class="d-flex align-items-center gap-2">
                    <span style="font-size:22px"><?= esc($p['icon']) ?></span>
                    <span><?= esc($p['nama']) ?></span>
                  </span>
                  <span class="d-flex align-items-center gap-3">
                    <span class="text-grad fw-semibold">Rp <?= number_format($p['harga'], 0, ',', '.') ?></span>
                    <a href="<?= $waLink ?>" target="_blank" class="btn btn-sm btn-outline-accent py-1 px-3">Order</a>
                  </span>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            <div class="empty"><div class="em">📱</div>Produk belum tersedia.</div>
          <?php endif; ?>
        </div>
      </div>

      <!-- KETENTUAN -->
      <div class="col-12 col-lg-5">
        <div class="zp-card p-4 h-100 reveal">
          <h2 class="h5 mb-3">📌 Ketentuan Layanan</h2>
          <ul class="ketentuan-list">
            <?php foreach ($ketentuan as $k): ?>
              <li><span class="k-ico">✓</span><span><?= esc($k) ?></span></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

    </div>
  </div>
</section>

<?= $this->include('template/footer') ?>