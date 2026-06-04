<?= $this->include('template/header') ?>

<?php
  $set = $pengaturan ?? [];
  // Nomor WA untuk order (fallback ke nomor toko bila ada di pengaturan)
  $waNumber = '6285177838705';
?>

<!-- HERO -->
<header class="section text-center" style="padding-top:140px">
  <div class="container">
    <h1 class="fw-bold reveal">Sosmed <span class="text-grad">Boost</span></h1>
    <p class="text-muted-2 reveal mx-auto" style="max-width:620px">
      Tingkatkan followers, likes, views, dan share TikTok &amp; Instagram-mu. Harga jujur, proses cepat.
    </p>
  </div>
</header>

<!-- KALKULATOR -->
<section class="section pt-0">
  <div class="container">
    <div class="row g-4 justify-content-center">
      <div class="col-12 col-lg-9">
        <div class="zp-card p-4 p-md-5 reveal">
          <h2 class="h5 mb-1 text-center">🧮 Hitung Harga Sendiri</h2>
          <p class="text-muted-2 text-center small mb-4">Pilih layanan, masukkan jumlah yang kamu mau, harga langsung muncul.</p>

          <div class="row g-3">
            <div class="col-12 col-md-4">
              <label class="form-label small text-muted-2">Platform</label>
              <select id="platform" class="form-select">
                <option value="">— Pilih —</option>
              </select>
            </div>
            <div class="col-12 col-md-4">
              <label class="form-label small text-muted-2">Layanan</label>
              <select id="layanan" class="form-select" disabled>
                <option value="">— Pilih platform dulu —</option>
              </select>
            </div>
            <div class="col-12 col-md-4">
              <label class="form-label small text-muted-2">Jumlah</label>
              <input type="number" id="jumlah" class="form-control" placeholder="contoh: 650" min="1">
              <div class="form-text text-muted-2" id="rangeHint"></div>
            </div>
          </div>

          <button class="btn btn-accent w-100 mt-4 py-2" id="btnHitung">Hitung Harga</button>

          <!-- Hasil -->
          <div id="resultBox" class="mt-4" style="display:none">
            <div class="calc-result text-center">
              <div class="text-muted-2 mb-1" id="resLabel">Estimasi Harga</div>
              <div class="calc-price text-white mb-3" id="resPrice">Rp 0</div>
              <a href="#" id="btnOrder" class="btn btn-accent px-4 py-2" target="_blank">💬 Order via WhatsApp</a>
            </div>
          </div>
          <div class="alert alert-danger mt-3" id="resultError" style="display:none"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- DAFTAR PAKET -->
<section class="section pt-0">
  <div class="container">
    <h2 class="section-title reveal">Daftar Paket</h2>
    <p class="section-sub reveal">Pilih paket siap pakai, atau hitung jumlah custom di atas</p>

    <?php if (!empty($struktur)): ?>
      <?php foreach ($struktur as $blok): ?>
        <div class="mb-5">
          <h3 class="h5 mb-3 reveal">
            <span class="badge badge-plat px-3 py-2"><?= esc($blok['platform']['nama']) ?></span>
          </h3>

          <div class="row g-4">
            <?php foreach ($blok['layanans'] as $lay): ?>
              <div class="col-12 col-md-6 col-lg-3">
                <div class="zp-card p-4 h-100 reveal">
                  <h4 class="h6 mb-3"><?= esc($lay['info']['nama']) ?></h4>
                  <ul class="list-unstyled mb-3">
                    <?php foreach ($lay['pakets'] as $pk): ?>
                      <?php
                        $teks = number_format($pk['jumlah'], 0, ',', '.') . ' ' . $lay['info']['nama'] .
                                ' (' . $blok['platform']['nama'] . ')';
                        $pesan = "Halo Zippy Store, saya mau order:%0A" .
                                 "*" . rawurlencode($teks) . "*%0A" .
                                 "Harga: Rp " . number_format($pk['harga'], 0, ',', '.');
                        $waLink = "https://wa.me/{$waNumber}?text={$pesan}";
                      ?>
                      <li class="d-flex justify-content-between align-items-center py-2" style="border-bottom:1px solid var(--zp-border)">
                        <span class="small">
                          <strong><?= number_format($pk['jumlah'], 0, ',', '.') ?></strong>
                          <span class="text-muted-2">pcs</span>
                        </span>
                        <span class="d-flex align-items-center gap-2">
                          <span class="text-grad fw-semibold">Rp <?= number_format($pk['harga'], 0, ',', '.') ?></span>
                          <a href="<?= $waLink ?>" target="_blank" class="btn btn-sm btn-outline-accent py-1 px-2" title="Order paket ini">Order</a>
                        </span>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                  <div class="text-muted-2" style="font-size:12px">
                    Min <?= number_format($lay['info']['min_order'], 0, ',', '.') ?> ·
                    Max <?= number_format($lay['info']['max_order'], 0, ',', '.') ?>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="empty reveal"><div class="em">📦</div>Paket belum tersedia. Cek lagi nanti ya!</div>
    <?php endif; ?>
  </div>
</section>

<?= $this->include('template/footer') ?>

<script>
  // Nomor WA untuk order custom
  const WA_NUMBER = '<?= $waNumber ?>';

  // Data layanan dari server
  const LAYANAN = <?= json_encode(array_map(function($l){
      return [
        'id'=>(int)$l['id'], 'nama'=>$l['nama'],
        'platform_id'=>(int)$l['platform_id'], 'platform_nama'=>$l['platform_nama'],
        'min'=>(int)$l['min_order'], 'max'=>(int)$l['max_order'],
      ];
  }, $layananFlat)) ?>;

  // Isi dropdown platform (unik)
  const elPlat = document.getElementById('platform');
  const elLay  = document.getElementById('layanan');
  const elJml  = document.getElementById('jumlah');
  const hint   = document.getElementById('rangeHint');

  const platformMap = {};
  LAYANAN.forEach(l => { platformMap[l.platform_id] = l.platform_nama; });
  Object.keys(platformMap).forEach(pid => {
    elPlat.insertAdjacentHTML('beforeend', `<option value="${pid}">${platformMap[pid]}</option>`);
  });

  elPlat.addEventListener('change', () => {
    const pid = parseInt(elPlat.value);
    elLay.innerHTML = '<option value="">— Pilih Layanan —</option>';
    if (!pid) { elLay.disabled = true; hint.textContent=''; return; }
    LAYANAN.filter(l => l.platform_id === pid).forEach(l => {
      elLay.insertAdjacentHTML('beforeend',
        `<option value="${l.id}" data-min="${l.min}" data-max="${l.max}" data-nama="${l.nama}">${l.nama}</option>`);
    });
    elLay.disabled = false;
    hint.textContent = '';
  });

  elLay.addEventListener('change', () => {
    const opt = elLay.selectedOptions[0];
    hint.textContent = (opt && opt.dataset.min)
      ? `Rentang: ${(+opt.dataset.min).toLocaleString('id-ID')} – ${(+opt.dataset.max).toLocaleString('id-ID')}`
      : '';
  });

  document.getElementById('btnHitung').addEventListener('click', async () => {
    const layanan_id = elLay.value;
    const jumlah = elJml.value;
    const errBox = document.getElementById('resultError');
    const resBox = document.getElementById('resultBox');
    errBox.style.display = 'none';

    if (!layanan_id || !jumlah) {
      errBox.textContent = 'Pilih layanan dan isi jumlah dulu ya.';
      errBox.style.display = 'block'; resBox.style.display = 'none';
      return;
    }

    const fd = new FormData();
    fd.append('layanan_id', layanan_id);
    fd.append('jumlah', jumlah);
    fd.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

    try {
      const res = await fetch('<?= base_url('sosmed/hitung') ?>', { method:'POST', body:fd });
      const json = await res.json();

      if (!json.ok) {
        errBox.textContent = json.msg; errBox.style.display = 'block'; resBox.style.display = 'none';
        return;
      }

      // Tampilkan hasil
      const platNama = elPlat.selectedOptions[0].textContent;
      document.getElementById('resLabel').textContent =
        `${json.jumlah.toLocaleString('id-ID')} ${json.layanan} (${platNama})`;
      document.getElementById('resPrice').textContent = json.harga_fmt;

      // Susun link WA
      const teks = `${json.jumlah.toLocaleString('id-ID')} ${json.layanan} (${platNama})`;
      const pesan = `Halo Zippy Store, saya mau order:%0A*${encodeURIComponent(teks)}*%0AHarga: ${json.harga_fmt}`;
      document.getElementById('btnOrder').href = `https://wa.me/${WA_NUMBER}?text=${pesan}`;

      resBox.style.display = 'block';
    } catch (e) {
      errBox.textContent = 'Terjadi kesalahan. Coba lagi.'; errBox.style.display = 'block';
    }
  });
</script>