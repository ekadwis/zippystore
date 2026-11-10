<?= $this->include('template/header') ?>

<?php
  function galSrc($f) {
      if (empty($f)) return '';
      return (str_starts_with($f, 'http://') || str_starts_with($f, 'https://')) ? $f : base_url($f);
  }
  $katLabel = ['surat'=>'Surat','tugas'=>'Tugas','premium'=>'Premium','sosmed'=>'Sosmed'];
?>

<header class="section text-center" style="padding-top:140px;padding-bottom:40px">
  <div class="container">
    <div class="d-inline-flex align-items-center gap-2 mb-3 reveal">
      <span class="badge-trust">PORTOFOLIO &amp; DOKUMENTASI</span>
      <span class="badge-trust">Arsip Pengerjaan</span>
    </div>
    <h1 class="fw-bold reveal">Galeri <span class="text-grad">Hasil Pengerjaan</span></h1>
    <p class="text-muted-2 reveal mx-auto" style="max-width:640px">
      Sampel dokumentasi pekerjaan yang telah diselesaikan oleh tim Zippy Store — surat administrasi, tugas akademik/IT, konfigurasi akun premium, hingga hasil boost sosmed.
    </p>
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
          <?php 
            $src = galSrc($g['file']); 
            $hasLink = !empty($g['link']);
          ?>
          <div class="g-item reveal" 
               data-full="<?= esc($src, 'attr') ?>" 
               data-nama="<?= esc($g['nama'], 'attr') ?>"
               data-link="<?= esc($g['link'] ?? '', 'attr') ?>"
               data-deskripsi="<?= esc($g['deskripsi'] ?? '', 'attr') ?>">
            <div class="position-relative">
              <img src="<?= esc($src, 'attr') ?>" alt="<?= esc($g['nama']) ?>" loading="lazy">
              <div class="zoom-ico">🔍</div>
              <?php if ($hasLink): ?>
                <span class="badge bg-dark text-white position-absolute top-0 end-0 m-2 px-2 py-1 small border border-light" style="font-size:11px; z-index:2">
                  🔗 Demo Link
                </span>
              <?php endif; ?>
            </div>
            <div class="g-cap d-flex justify-content-between align-items-center">
              <div>
                <span class="g-nama d-block"><?= esc($g['nama']) ?></span>
                <span class="g-kat"><?= esc($katLabel[$g['kategori']] ?? ucfirst($g['kategori'])) ?></span>
              </div>
              <?php if ($hasLink): ?>
                <a href="<?= esc($g['link']) ?>" target="_blank" rel="noopener" class="btn btn-sm btn-outline-dark py-1 px-2 fw-semibold" onclick="event.stopPropagation();" title="Kunjungi Website">
                  Buka &rarr;
                </a>
              <?php endif; ?>
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
    <div class="modal-content" style="background:#ffffff;border:2px solid #18181b;box-shadow:6px 6px 0px 0px #18181b">
      <div class="modal-body p-3 position-relative text-center">
        <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" style="z-index:2"></button>
        <img src="" alt="" id="galModalImg" style="max-height:75vh;max-width:100%;border-radius:8px;border:2px solid #18181b">
        
        <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2 text-start">
          <div>
            <div id="galModalCap" class="text-dark fw-bold fs-6"></div>
            <div id="galModalDesc" class="text-muted-2 small"></div>
          </div>
          <a href="#" id="galModalLink" target="_blank" rel="noopener" class="btn btn-accent px-4 py-2 fw-bold" style="display:none">
            🌐 Kunjungi Website / Demo &rarr;
          </a>
        </div>
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
  const galImg     = document.getElementById('galModalImg');
  const galCap     = document.getElementById('galModalCap');
  const galDesc    = document.getElementById('galModalDesc');
  const galLink    = document.getElementById('galModalLink');

  document.querySelectorAll('.g-item').forEach(item => {
    item.addEventListener('click', () => {
      galImg.src = item.dataset.full;
      galCap.textContent = item.dataset.nama || '';
      
      // Deskripsi
      if (item.dataset.deskripsi) {
        galDesc.textContent = item.dataset.deskripsi;
        galDesc.style.display = 'block';
      } else {
        galDesc.textContent = '';
        galDesc.style.display = 'none';
      }

      // Link Demo Website
      if (item.dataset.link) {
        galLink.href = item.dataset.link;
        galLink.style.display = 'inline-flex';
      } else {
        galLink.href = '#';
        galLink.style.display = 'none';
      }

      bootstrap.Modal.getOrCreateInstance(galModalEl).show();
    });
  });
</script>