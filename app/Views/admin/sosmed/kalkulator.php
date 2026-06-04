<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="row g-4">
  <!-- Form -->
  <div class="col-12 col-lg-5">
    <div class="zp-card p-4">
      <h2 class="h6 mb-3">Hitung Harga Custom</h2>

      <div class="mb-3">
        <label class="form-label">Platform</label>
        <select id="platform" class="form-select">
          <option value="">— Pilih Platform —</option>
          <?php foreach ($platforms as $p): ?>
            <option value="<?= $p['id'] ?>"><?= esc($p['nama']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Layanan</label>
        <select id="layanan" class="form-select" disabled>
          <option value="">— Pilih platform dulu —</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Jumlah</label>
        <input type="number" id="jumlah" class="form-control" placeholder="contoh: 750" min="1">
        <div class="form-text text-muted-2" id="rangeHint"></div>
      </div>

      <button class="btn btn-accent w-100" id="btnHitung">🧮 Hitung Harga</button>
    </div>
  </div>

  <!-- Result -->
  <div class="col-12 col-lg-7">
    <div class="calc-result h-100 d-flex flex-column justify-content-center" id="resultBox">
      <div class="text-muted-2 text-center py-4" id="resultEmpty">Hasil perhitungan akan muncul di sini.</div>
      <div id="resultData" style="display:none">
        <div class="text-muted-2 mb-1">Estimasi Harga</div>
        <div class="calc-price text-white" id="resPrice">Rp 0</div>
        <hr style="border-color:var(--zp-border)">
        <div class="row small">
          <div class="col-6 mb-2"><span class="text-muted-2">Tier:</span> <span id="resTier">-</span></div>
          <div class="col-6 mb-2"><span class="text-muted-2">Harga/unit:</span> <span id="resUnit">-</span></div>
          <div class="col-12"><span class="text-muted-2">Paket terdekat:</span> <span id="resRef">-</span></div>
        </div>
      </div>
      <div class="alert alert-danger mt-2" id="resultError" style="display:none"></div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  // Data layanan (dari server) untuk dropdown bertingkat
  const LAYANAN = <?= json_encode(array_map(function($l){
      return ['id'=>(int)$l['id'],'nama'=>$l['nama'],'platform_id'=>(int)$l['platform_id'],'min'=>(int)$l['min_order'],'max'=>(int)$l['max_order']];
  }, $layanans)) ?>;

  const elPlat = document.getElementById('platform');
  const elLay  = document.getElementById('layanan');
  const elJml  = document.getElementById('jumlah');
  const hint   = document.getElementById('rangeHint');

  elPlat.addEventListener('change', () => {
    const pid = parseInt(elPlat.value);
    elLay.innerHTML = '<option value="">— Pilih Layanan —</option>';
    if (!pid) { elLay.disabled = true; return; }
    LAYANAN.filter(l => l.platform_id === pid).forEach(l => {
      elLay.insertAdjacentHTML('beforeend', `<option value="${l.id}" data-min="${l.min}" data-max="${l.max}">${l.nama}</option>`);
    });
    elLay.disabled = false;
    hint.textContent = '';
  });

  elLay.addEventListener('change', () => {
    const opt = elLay.selectedOptions[0];
    if (opt && opt.dataset.min) {
      hint.textContent = `Rentang: ${(+opt.dataset.min).toLocaleString('id-ID')} – ${(+opt.dataset.max).toLocaleString('id-ID')}`;
    } else hint.textContent = '';
  });

  document.getElementById('btnHitung').addEventListener('click', async () => {
    const layanan_id = elLay.value;
    const jumlah = elJml.value;
    const errBox = document.getElementById('resultError');
    const dataBox = document.getElementById('resultData');
    const emptyBox = document.getElementById('resultEmpty');
    errBox.style.display = 'none';

    if (!layanan_id || !jumlah) {
      errBox.textContent = 'Pilih layanan dan isi jumlah dulu.';
      errBox.style.display = 'block'; dataBox.style.display='none'; emptyBox.style.display='none';
      return;
    }

    const fd = new FormData();
    fd.append('layanan_id', layanan_id);
    fd.append('jumlah', jumlah);
    fd.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

    try {
      const res = await fetch('<?= site_url('admin/sosmed/kalkulator/hitung') ?>', { method:'POST', body:fd });
      const json = await res.json();
      emptyBox.style.display = 'none';

      if (!json.ok) {
        errBox.textContent = json.msg; errBox.style.display='block'; dataBox.style.display='none';
        return;
      }
      document.getElementById('resPrice').textContent = json.harga_fmt;
      document.getElementById('resTier').textContent  = json.tier;
      document.getElementById('resUnit').textContent  = 'Rp ' + Number(json.unit).toLocaleString('id-ID');
      document.getElementById('resRef').textContent   = json.ref ? `${json.ref.jumlah.toLocaleString('id-ID')} → ${json.ref.harga}` : '-';
      dataBox.style.display = 'block';
    } catch (e) {
      errBox.textContent = 'Terjadi kesalahan. Coba lagi.'; errBox.style.display='block';
    }
  });
</script>
<?= $this->endSection() ?>