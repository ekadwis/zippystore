<?= $this->include('template/header') ?>

<?php
  function galSrc($f) {
      if (empty($f)) return '';
      return (str_starts_with($f, 'http://') || str_starts_with($f, 'https://')) ? $f : base_url($f);
  }
  $katLabel = ['surat'=>'Surat','tugas'=>'Tugas','premium'=>'Premium','sosmed'=>'Sosmed'];
?>

<header class="section text-center" style="padding-top:140px">
  <div class="container">
    <h1 class="fw-bold reveal">Gallery</h1>
    <p class="text-muted-2 reveal">Kumpulan hasil pekerjaan kami — surat, tugas, premium, sosmed, dan lainnya.</p>
  </div>
</header>

<section class="section pt-0">
  <div class="container">

    <!-- Tools: search + filter -->
    <div class="d-flex flex-wrap gap-3 justify-content-between mb-4">
      <form class="flex-grow-1" style="min-width:220px;max-width:360px" action="<?= base_url('gallery') ?>" method="get">
        <?php if (!empty($kategori) && $kategori !== 'semua'): ?>
          <input type="hidden" name="kategori" value="<?= esc($kategori, 'attr') ?>">
        <?php endif; ?>
        <div class="d-flex gap-2">
          <input type="text" name="q" class="form-control" placeholder="Cari gambar..." value="<?= esc($keyword ?? '', 'attr') ?>">
          <button class="btn btn-accent px-3" type="submit">Cari</button>
        </div>
      </form>

      <div class="d-flex gap-2 flex-wrap">
        <?php
          $cats = ['semua'=>'Semua','surat'=>'Surat','tugas'=>'Tugas','premium'=>'Premium','sosmed'=>'Sosmed'];
          foreach ($cats as $key => $label):
        ?>
          <button class="btn btn-sm filter-btn px-3 <?= ($kategori ?? 'semua') === $key ? 'active' : '' ?>" data-kategori="<?= $key ?>"><?= $label ?></button>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Info hasil pencarian -->
    <?php if (!empty($keyword)): ?>
      <p class="text-muted-2 small mb-3">Hasil pencarian untuk "<strong><?= esc($keyword) ?></strong>" — <?= count($galeri) ?> gambar ditemukan.</p>
    <?php endif; ?>

    <!-- Masonry grid -->
    <?php if (!empty($galeri)): ?>
      <div class="gallery-masonry">
        <?php foreach ($galeri as $g): ?>
          <?php $src = galSrc($g['file']); ?>
          <div class="g-item reveal" data-full="<?= esc($src, 'attr') ?>" data-nama="<?= esc($g['nama'], 'attr') ?>">
            <div class="position-relative">
              <img src="<?= esc($src, 'attr') ?>" alt="<?= esc($g['nama']) ?>" loading="lazy">
              <div class="zoom-ico">🔍</div>
            </div>
            <div class="g-cap">
              <span class="g-nama"><?= esc($g['nama']) ?></span>
              <span class="g-kat"><?= esc($katLabel[$g['kategori']] ?? ucfirst($g['kategori'])) ?></span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="empty reveal">
        <div class="em">🖼️</div>
        <?php if (!empty($keyword) || (!empty($kategori) && $kategori !== 'semua')): ?>
          Tidak ada gambar yang cocok. <a href="<?= base_url('gallery') ?>" class="text-grad">Reset filter</a>.
        <?php else: ?>
          Belum ada gambar di galeri.
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- Lightbox -->
<div class="modal fade" id="galModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="background:var(--card);border:1px solid var(--border)">
      <div class="modal-body p-2 position-relative text-center">
        <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" style="z-index:2"></button>
        <img src="" alt="" id="galModalImg" style="max-height:82vh;max-width:100%;border-radius:10px">
        <div id="galModalCap" class="text-muted-2 small py-2"></div>
      </div>
    </div>
  </div>
</div>

<?= $this->include('template/footer') ?>

<script>
  // Filter (ubah param kategori, pertahankan keyword)
  document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const k = btn.dataset.kategori;
      const url = new URL(window.location.href);
      if (k && k !== 'semua') url.searchParams.set('kategori', k);
      else url.searchParams.delete('kategori');
      window.location.href = url.toString();
    });
  });

  // Lightbox
  const galModalEl = document.getElementById('galModal');
  const galImg = document.getElementById('galModalImg');
  const galCap = document.getElementById('galModalCap');
  document.querySelectorAll('.g-item').forEach(item => {
    item.addEventListener('click', () => {
      galImg.src = item.dataset.full;
      galCap.textContent = item.dataset.nama || '';
      bootstrap.Modal.getOrCreateInstance(galModalEl).show();
    });
  });
</script>