<?php
/**
 * Komponen Jumbotron / Flash Sale Banner Interaktif
 * Desain: Neo-Brutalist Light / Chunky Pop (Anti-AI Slop)
 * Variabel pendukung: $flashSale, $pengaturan
 */
$fs = $flashSale ?? (new \App\Models\FlashSaleModel())->getActiveFlashSale();
if (empty($fs) || empty($fs['is_active'])) {
    return;
}

$set = $pengaturan ?? [];
$waNumber = !empty($set['no_wa']) ? preg_replace('/[^0-9]/', '', $set['no_wa']) : '6285177838705';
$items = $fs['items'] ?? [];
$endTime = !empty($fs['end_time']) ? $fs['end_time'] : date('Y-m-d H:i:s', strtotime('+8 hours'));
?>

<!-- FLASH SALE JUMBOTRON SECTION -->
<section id="flash-sale-jumbotron" class="section py-4">
  <div class="container">
    <div class="flash-sale-card">
      <!-- Top Decorative Ribbons & Header -->
      <div class="flash-sale-header d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div class="d-flex align-items-center gap-2 flex-wrap">
          <span class="fs-badge-sticker">
            <?= esc($fs['badge_text'] ?? '⚡ FLASH SALE TERBATAS') ?>
          </span>
          <span class="fs-badge-guarantee">
            🛡️ Garansi Resmi 25–30 Hari
          </span>
        </div>

        <!-- Countdown Timer Chunky Box -->
        <div class="fs-timer-container d-flex align-items-center gap-2" id="flash-countdown-wrap" data-endtime="<?= esc($endTime) ?>">
          <span class="fs-timer-label">BERAKHIR DALAM:</span>
          <div class="fs-timer-box">
            <span class="fs-timer-num" id="fs-hours">00</span>
            <span class="fs-timer-unit">JAM</span>
          </div>
          <span class="fs-timer-sep">:</span>
          <div class="fs-timer-box">
            <span class="fs-timer-num" id="fs-minutes">00</span>
            <span class="fs-timer-unit">MNT</span>
          </div>
          <span class="fs-timer-sep">:</span>
          <div class="fs-timer-box">
            <span class="fs-timer-num" id="fs-seconds">00</span>
            <span class="fs-timer-unit">DTK</span>
          </div>
        </div>
      </div>

      <!-- Main Headline & Subtitle -->
      <div class="flash-sale-hero-body mt-3 mb-4">
        <div class="row align-items-center">
          <div class="col-lg-8">
            <h2 class="fs-title mb-2"><?= esc($fs['judul'] ?? '⚡ KILAT ZIPPY: FLASH SALE AKHIR PEKAN') ?></h2>
            <p class="fs-subtitle mb-0">
              <?= esc($fs['subjudul'] ?? 'Klaim slot harga spesial untuk akun premium bergaransi, optimasi sosmed, dan joki express. Kuota terbatas per hari!') ?>
            </p>
          </div>
          <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
            <div class="fs-meta-pill d-inline-flex align-items-center gap-2">
              <span class="fs-dot-pulse"></span>
              <span>Metode: Instant QRIS &amp; Transfer Bank</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Grid Produk Flash Sale (2-4 Item Pop) -->
      <?php if (!empty($items)): ?>
      <div class="row g-3">
        <?php foreach ($items as $idx => $item): 
          $origPrice = (int)($item['original_price'] ?? 0);
          $discPrice = (int)($item['discount_price'] ?? 0);
          $totalQuota = (int)($item['total_quota'] ?? 20);
          $soldQuota  = (int)($item['sold_quota'] ?? 15);
          $pct = $totalQuota > 0 ? min(100, round(($soldQuota / $totalQuota) * 100)) : 75;
          $sisaQuota  = max(0, $totalQuota - $soldQuota);
          $waMsg = !empty($item['whatsapp_text']) ? $item['whatsapp_text'] : "Halo Zippy Store, saya mau klaim Flash Sale " . ($item['name'] ?? 'Produk') . " seharga Rp " . number_format($discPrice, 0, ',', '.');
          $itemWaLink = "https://wa.me/{$waNumber}?text=" . rawurlencode($waMsg);
        ?>
        <div class="col-12 col-sm-6 col-lg-3">
          <div class="fs-item-card h-100 d-flex flex-column justify-content-between">
            <div>
              <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="fs-item-cat"><?= esc($item['category'] ?? 'Digital') ?></span>
                <?php if (!empty($item['badge'])): ?>
                  <span class="fs-item-badge"><?= esc($item['badge']) ?></span>
                <?php endif; ?>
              </div>

              <h3 class="fs-item-name mb-3"><?= esc($item['name'] ?? 'Paket Promo') ?></h3>

              <div class="fs-price-wrap mb-3">
                <?php if ($origPrice > $discPrice): ?>
                  <div class="fs-price-strike">Rp <?= number_format($origPrice, 0, ',', '.') ?></div>
                <?php endif; ?>
                <div class="fs-price-final">Rp <?= number_format($discPrice, 0, ',', '.') ?></div>
              </div>

              <!-- Quota Progress Bar -->
              <div class="fs-quota-wrap mb-3">
                <div class="d-flex justify-content-between fs-quota-text mb-1">
                  <span>Slot Terjual: <strong><?= $soldQuota ?>/<?= $totalQuota ?></strong></span>
                  <span class="text-danger-emphasis fw-bold">Sisa <?= $sisaQuota ?> slot</span>
                </div>
                <div class="fs-progress-track">
                  <div class="fs-progress-bar" style="width: <?= $pct ?>%;"></div>
                </div>
              </div>
            </div>

            <!-- CTA Button -->
            <a href="<?= esc($itemWaLink) ?>" target="_blank" rel="noopener" class="btn fs-btn-claim w-100 mt-2">
              ⚡ Klaim Promo (WA)
            </a>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

      <!-- Bottom Banner Footnote -->
      <div class="fs-footer-note mt-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div class="d-flex align-items-center gap-2">
          <span>🔒 <strong>Anti Ribet:</strong> Tanpa antre lama, pembayaran diproses otomatis, garansi dipantau langsung admin.</span>
        </div>
        <a href="#tiket-layanan" class="fs-link-all">Lihat Semua Layanan Reguler →</a>
      </div>
    </div>
  </div>
</section>

<!-- Countdown Script -->
<script>
(function() {
  const countdownWrap = document.getElementById('flash-countdown-wrap');
  if (!countdownWrap) return;

  const endTimeStr = countdownWrap.getAttribute('data-endtime');
  if (!endTimeStr) return;

  const targetDate = new Date(endTimeStr.replace(/-/g, '/')).getTime();

  function updateTimer() {
    const now = new Date().getTime();
    let distance = targetDate - now;

    if (distance < 0) {
      distance = 0;
      const hoursEl = document.getElementById('fs-hours');
      const minEl = document.getElementById('fs-minutes');
      const secEl = document.getElementById('fs-seconds');
      if (hoursEl) hoursEl.textContent = '00';
      if (minEl) minEl.textContent = '00';
      if (secEl) secEl.textContent = '00';
      return;
    }

    const hours = Math.floor(distance / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    const hoursEl = document.getElementById('fs-hours');
    const minEl = document.getElementById('fs-minutes');
    const secEl = document.getElementById('fs-seconds');

    if (hoursEl) hoursEl.textContent = String(hours).padStart(2, '0');
    if (minEl) minEl.textContent = String(minutes).padStart(2, '0');
    if (secEl) secEl.textContent = String(seconds).padStart(2, '0');
  }

  updateTimer();
  setInterval(updateTimer, 1000);
})();
</script>
