<?= $this->include('template/header') ?>

<?php
    $telegram = $telegramLink ?? 'https://t.me/' . env('telegram.channelUsername', 'klddies');
?>

<!-- HERO & TELEGRAM REDIRECT -->
<section class="section text-center" style="padding-top:160px;padding-bottom:100px">
  <div class="container" style="max-width:760px">
    
    <div class="d-inline-flex align-items-center gap-2 mb-3 reveal">
      <span class="badge-trust">🛡️ RESMI &amp; TRANSPARAN</span>
      <span class="badge-trust">1.000–5.000+ Transaksi Sukses</span>
    </div>

    <h1 class="fw-bold display-6 mb-3 reveal">
      Arsip &amp; Bukti <span class="text-grad">Testimoni Pelanggan</span>
    </h1>

    <p class="text-muted-2 reveal mx-auto mb-4" style="max-width:600px;font-size:1.05rem;line-height:1.7">
      Demi menjaga transparansi dan keaslian tanpa rekayasa, seluruh tangkapan layar bukti pengerjaan, testimoni pelanggan, dan riwayat transaksi Zippy Store sejak 2019 diarsipkan langsung secara realtime di <strong>Channel Telegram Resmi</strong> kami.
    </p>

    <!-- BOX TELEGRAM CALL TO ACTION -->
    <div class="zp-card p-4 p-md-5 reveal text-center my-4" style="background:#f0fdf4; border:2px solid var(--zp-border-solid); box-shadow:6px 6px 0px 0px #18181b">
      <div style="font-size:56px; margin-bottom:12px">✈️</div>
      <h3 class="h4 fw-bold mb-2">Lihat Ribuan Bukti di Telegram</h3>
      <p class="text-muted-2 small mb-4 mx-auto" style="max-width:480px">
        Bergabunglah bersama ratusan member lainnya dan cek langsung riwayat kepuasan pelanggan Zippy Store kapan saja tanpa sensor.
      </p>

      <a href="<?= esc($telegram) ?>" target="_blank" rel="noopener" class="btn btn-accent btn-lg px-5 py-3 fw-bold d-inline-flex align-items-center gap-2 shadow-sm">
        <i class="fab fa-telegram-plane"></i> Buka Channel Testimoni Telegram &rarr;
      </a>
      
      <div class="mt-3 text-muted-2 small">
        Atau buka link: <a href="<?= esc($telegram) ?>" target="_blank" class="fw-semibold text-accent"><?= esc($telegram) ?></a>
      </div>
    </div>

    <!-- NOTICE KEASLIAN -->
    <div class="testi-notice reveal text-start mt-5">
      <h4>⚠️ Pemberitahuan Keaslian &amp; Hak Cipta</h4>
      <p class="small text-muted-2 mb-0" style="line-height:1.6">
        Seluruh testimoni dan tangkapan layar yang ada di channel Telegram resmi adalah <strong>asli</strong> dan merupakan hak milik Zippy Store. Dilarang keras mengambil, menyalin, mengunduh, mengedit, atau menggunakan kembali bukti testimoni tanpa izin tertulis dari Zippy Store.
      </p>
    </div>

  </div>
</section>

<?= $this->include('template/footer') ?>
