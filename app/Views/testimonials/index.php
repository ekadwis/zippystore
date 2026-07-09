<?= $this->include('template/header') ?>

<?php
    $telegram    = $telegramLink ?? 'https://t.me/klddies';
    $fromTg      = $fromTelegram ?? false;

    function testiSrc($g) {
        if (empty($g)) return '';
        return (str_starts_with($g, 'http://') || str_starts_with($g, 'https://'))
            ? $g : base_url($g);
    }

    $list = !empty($testimoni) ? $testimoni : [];
?>

<!-- HERO -->
<header class="section text-center" style="padding-top:140px">
  <div class="container">
    <h1 class="fw-bold reveal">Kata <span class="text-grad">Mereka</span></h1>
    <p class="text-muted-2 reveal mx-auto" style="max-width:640px">
      Ratusan pelanggan sudah mempercayai Zippy Store. Ini bukti nyatanya.
    </p>
  </div>
</header>

<!-- BANNER TELEGRAM -->
<section class="pt-0" style="padding-bottom:32px">
  <div class="container">
    <div class="telegram-banner d-flex align-items-center gap-3 flex-wrap reveal">
      <div class="tg-ico">✈️</div>
      <div class="flex-grow-1">
        <h3 class="h6 mb-1">
          <?php if ($fromTg): ?>
            Menampilkan 16 foto terbaru langsung dari channel Telegram kami
          <?php else: ?>
            Semua testimoni asli ada di Telegram kami
          <?php endif; ?>
        </h3>
        <p class="text-muted-2 small mb-0">
          <?php if ($fromTg): ?>
            Foto diperbarui otomatis setiap 30 menit dari
            <a href="<?= esc($telegram) ?>" target="_blank" class="text-accent"><?= esc($telegram) ?></a>.
          <?php else: ?>
            Arsip lengkap & real-time bisa kamu cek langsung di channel Telegram kami.
          <?php endif; ?>
        </p>
      </div>
      <a href="<?= esc($telegram) ?>" target="_blank" class="btn btn-accent px-4">Buka Telegram</a>
    </div>
  </div>
</section>

<!-- GRID FOTO -->
<section class="pt-0">
  <div class="container">
    <?php if (!empty($list)): ?>
      <div class="testi-grid">
        <?php foreach ($list as $t): ?>
          <?php $src = testiSrc($t['gambar']); ?>
          <div class="testi-photo reveal" data-full="<?= esc($src, 'attr') ?>">
            <img src="<?= esc($src, 'attr') ?>"
                 alt="Testimoni <?= esc($t['nama'] ?? 'Zippy Store') ?>"
                 loading="lazy"
                 onerror="this.closest('.testi-photo').style.display='none'">
            <div class="zoom-ico">🔍</div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- See all -> Telegram -->
      <div class="text-center mt-5 reveal">
        <p class="text-muted-2 small mb-3">
          Menampilkan <?= count($list) ?> foto terbaru.
          Mau lihat semuanya?
        </p>
        <a href="<?= esc($telegram) ?>" target="_blank" class="btn btn-accent btn-lg px-5">
          ✈️ Lihat Semua di Telegram
        </a>
      </div>

    <?php else: ?>
      <!-- Fallback: tidak ada foto dari Telegram -->
      <div class="empty reveal">
        <div class="em">📷</div>
        <p class="mb-3">Foto testimoni sedang dimuat dari Telegram…</p>
        <a href="<?= esc($telegram) ?>" target="_blank" class="btn btn-accent px-4">
          ✈️ Cek Langsung di Telegram
        </a>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- NOTICE KEASLIAN -->
<section class="pt-0">
  <div class="container">
    <div class="testi-notice reveal">
      <h4>⚠️ Pemberitahuan Keaslian & Hak Cipta</h4>
      <p>
        Seluruh testimoni dan screenshot yang ditampilkan di halaman ini adalah <strong>asli</strong> dan merupakan
        hak milik Zippy Store. Dilarang keras mengambil, menyalin, mengunduh, mengedit, atau menggunakan kembali
        gambar maupun konten testimoni ini tanpa izin tertulis dari Zippy Store, baik untuk keperluan pribadi maupun komersial.
        <br><br>
        Pelanggaran atas ketentuan ini dapat dikenakan <strong>sanksi denda hingga Rp 50.000.000 (lima puluh juta rupiah)</strong>
        dan/atau tuntutan hukum sesuai peraturan perundang-undangan yang berlaku di Republik Indonesia, termasuk namun tidak
        terbatas pada Undang-Undang Nomor 28 Tahun 2014 tentang Hak Cipta dan Undang-Undang Nomor 11 Tahun 2008 tentang
        Informasi dan Transaksi Elektronik (UU ITE) beserta perubahannya.
        <br><br>
        Dengan mengakses halaman ini, Anda dianggap telah membaca, memahami, dan menyetujui ketentuan tersebut.
      </p>
    </div>
  </div>
</section>

<!-- Lightbox (Bootstrap modal) -->
<div class="modal fade" id="testiModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:var(--card);border:1px solid var(--border)">
      <div class="modal-body p-2 position-relative text-center">
        <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" style="z-index:2"></button>
        <img src="" alt="Testimoni" style="max-height:80vh;max-width:100%;border-radius:10px" id="testiModalImg">
      </div>
    </div>
  </div>
</div>

<?= $this->include('template/footer') ?>

<script>
  // Lightbox zoom (pakai Bootstrap modal yang sudah ada di footer bundle)
  const modalEl  = document.getElementById('testiModal');
  const modalImg = document.getElementById('testiModalImg');
  document.querySelectorAll('.testi-photo').forEach(box => {
    box.addEventListener('click', () => {
      modalImg.src = box.dataset.full;
      bootstrap.Modal.getOrCreateInstance(modalEl).show();
    });
  });
</script>