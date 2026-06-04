<?= $this->include('template/header') ?>

<?php $waNumber = $waNumber ?? '6285177838705'; ?>

<header class="section text-center" style="padding-top:140px">
  <div class="container">
    <h1 class="fw-bold reveal">App <span class="text-grad">Premium</span></h1>
    <p class="text-muted-2 reveal mx-auto" style="max-width:620px">
      Aplikasi premium murah & bergaransi. Pilih durasi sesukamu, langsung order via WhatsApp.
    </p>
  </div>
</header>

<section class="section pt-0">
  <div class="container">
    <?php if (!empty($struktur)): ?>
      <div class="row g-4">
        <?php foreach ($struktur as $blok): ?>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="zp-card p-4 h-100 reveal">
              <div class="d-flex align-items-center gap-2 mb-2">
                <span style="font-size:30px"><?= esc($blok['produk']['icon']) ?></span>
                <h3 class="h5 mb-0"><?= esc($blok['produk']['nama']) ?></h3>
              </div>
              <?php if (!empty($blok['produk']['deskripsi'])): ?>
                <p class="text-muted-2 small mb-3"><?= esc($blok['produk']['deskripsi']) ?></p>
              <?php endif; ?>

              <ul class="list-unstyled mb-0">
                <?php foreach ($blok['durasi'] as $d): ?>
                  <?php
                    $teks = $blok['produk']['nama'] . ' - ' . $d['label'];
                    $pesan = "Halo Zippy Store, saya mau order App Premium:%0A" .
                             "*" . rawurlencode($teks) . "*%0A" .
                             "Harga: Rp " . number_format($d['harga'], 0, ',', '.');
                    $waLink = "https://wa.me/{$waNumber}?text={$pesan}";
                  ?>
                  <li class="d-flex justify-content-between align-items-center py-2" style="border-bottom:1px solid var(--border)">
                    <span class="small"><?= esc($d['label']) ?></span>
                    <span class="d-flex align-items-center gap-2">
                      <span class="text-grad fw-semibold">Rp <?= number_format($d['harga'], 0, ',', '.') ?></span>
                      <a href="<?= $waLink ?>" target="_blank" class="btn btn-sm btn-outline-accent py-1 px-2">Order</a>
                    </span>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="empty reveal"><div class="em">🎬</div>Produk premium belum tersedia.</div>
    <?php endif; ?>
  </div>
</section>

<?= $this->include('template/footer') ?>