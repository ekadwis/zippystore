<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<?php
$fs = $flashSale ?? [];
$items = $fs['items'] ?? [];
$endTimeVal = !empty($fs['end_time']) ? date('Y-m-d\TH:i', strtotime($fs['end_time'])) : date('Y-m-d\TH:i', strtotime('+8 hours'));
?>

<div class="row g-4">
  <!-- FORM PENGATURAN FLASH SALE -->
  <div class="col-12 col-xl-8">
    <div class="zp-card p-4">
      <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
          <h2 class="h4 mb-1">⚡ Pengaturan Jumbotron Flash Sale</h2>
          <p class="text-muted small mb-0">Atur konten promosi kilat yang muncul di bagian atas halaman publik.</p>
        </div>
        <div>
          <span class="badge <?= !empty($fs['is_active']) ? 'badge-on' : 'badge-off' ?>">
            <?= !empty($fs['is_active']) ? 'STATUS: AKTIF DITAMPILKAN' : 'STATUS: NONAKTIF' ?>
          </span>
        </div>
      </div>

      <form action="<?= site_url('admin/flash-sale/save') ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= esc($fs['id'] ?? 0) ?>">

        <div class="row g-3 mb-4">
          <div class="col-12 col-md-6">
            <label class="form-label">Teks Badge Header</label>
            <input type="text" name="badge_text" class="form-control" value="<?= esc($fs['badge_text'] ?? '⚡ FLASH SALE TERBATAS') ?>" required placeholder="Contoh: ⚡ FLASH SALE TERBATAS">
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label">Target Jam Countdown Selesai</label>
            <input type="datetime-local" name="end_time" class="form-control" value="<?= esc($endTimeVal) ?>" required>
          </div>
          <div class="col-12">
            <label class="form-label">Judul Utama Banner</label>
            <input type="text" name="judul" class="form-control" value="<?= esc($fs['judul'] ?? '⚡ KILAT ZIPPY: FLASH SALE AKHIR PEKAN') ?>" required placeholder="Judul eye-catching...">
          </div>
          <div class="col-12">
            <label class="form-label">Subjudul / Deskripsi Banner</label>
            <textarea name="subjudul" class="form-control" rows="2" placeholder="Deskripsi singkat promo..."><?= esc($fs['subjudul'] ?? 'Ambil kuota promo akun bergaransi, kebutuhan sosmed, dan joki express sebelum timer habis!') ?></textarea>
          </div>
          <div class="col-12">
            <div class="form-check form-switch p-0 d-flex align-items-center gap-2">
              <input class="form-check-input ms-0 me-2" type="checkbox" name="is_active" id="isActiveCheck" value="1" <?= !empty($fs['is_active']) ? 'checked' : '' ?> style="width:2.5em; height:1.4em; border:2px solid #18181b;">
              <label class="form-check-label fw-bold" for="isActiveCheck">Tampilkan Banner Flash Sale di Halaman Publik</label>
            </div>
          </div>
        </div>

        <hr style="border-top: 2px dashed #18181b; margin: 28px 0;">

        <!-- DAFTAR PRODUK FLASH SALE -->
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h3 class="h5 mb-0">Daftar Item Flash Sale (Maksimal 4 Slot)</h3>
          <small class="text-muted fw-bold">Rekomendasi: 2 hingga 4 item pop</small>
        </div>

        <div id="itemsContainer">
          <?php 
          // Pastikan ada minimal 4 item slot untuk diedit
          $slotCount = max(4, count($items));
          for ($i = 0; $i < $slotCount; $i++):
            $item = $items[$i] ?? [
              'name' => '',
              'category' => 'Akun Premium',
              'badge' => '',
              'original_price' => 0,
              'discount_price' => 0,
              'total_quota' => 20,
              'sold_quota' => 0,
              'whatsapp_text' => ''
            ];
          ?>
          <div class="card p-3 mb-3" style="border: 2px solid #18181b; border-radius: 10px; background: #fff;">
            <div class="d-flex justify-content-between align-items-center mb-2 pb-2" style="border-bottom: 1.5px dashed #e4e4e7;">
              <span class="badge badge-plat">Slot #<?= $i + 1 ?></span>
              <span class="small text-muted">Item Promosi</span>
            </div>
            <div class="row g-2">
              <div class="col-12 col-md-6">
                <label class="form-label small">Nama Produk</label>
                <input type="text" name="item_name[]" class="form-control form-control-sm" value="<?= esc($item['name']) ?>" placeholder="Contoh: Spotify Premium 1 Bulan">
              </div>
              <div class="col-6 col-md-3">
                <label class="form-label small">Kategori</label>
                <select name="item_category[]" class="form-select form-select-sm">
                  <option value="Akun Premium" <?= ($item['category'] ?? '') === 'Akun Premium' ? 'selected' : '' ?>>Akun Premium</option>
                  <option value="Asistensi IT & Joki" <?= ($item['category'] ?? '') === 'Asistensi IT & Joki' ? 'selected' : '' ?>>Asistensi IT &amp; Joki</option>
                  <option value="Kebutuhan Sosmed" <?= ($item['category'] ?? '') === 'Kebutuhan Sosmed' ? 'selected' : '' ?>>Kebutuhan Sosmed</option>
                  <option value="Nomor OTP" <?= ($item['category'] ?? '') === 'Nomor OTP' ? 'selected' : '' ?>>Nomor OTP</option>
                </select>
              </div>
              <div class="col-6 col-md-3">
                <label class="form-label small">Label Stiker</label>
                <input type="text" name="item_badge[]" class="form-control form-control-sm" value="<?= esc($item['badge']) ?>" placeholder="Contoh: Garansi 30 Hari">
              </div>
              <div class="col-6 col-md-3">
                <label class="form-label small">Harga Coret (Rp)</label>
                <input type="number" name="item_original_price[]" class="form-control form-control-sm" value="<?= esc($item['original_price']) ?>" placeholder="35000">
              </div>
              <div class="col-6 col-md-3">
                <label class="form-label small">Harga Diskon (Rp)</label>
                <input type="number" name="item_discount_price[]" class="form-control form-control-sm" value="<?= esc($item['discount_price']) ?>" placeholder="12500">
              </div>
              <div class="col-6 col-md-3">
                <label class="form-label small">Total Kuota</label>
                <input type="number" name="item_total_quota[]" class="form-control form-control-sm" value="<?= esc($item['total_quota']) ?>" placeholder="25">
              </div>
              <div class="col-6 col-md-3">
                <label class="form-label small">Terjual</label>
                <input type="number" name="item_sold_quota[]" class="form-control form-control-sm" value="<?= esc($item['sold_quota']) ?>" placeholder="19">
              </div>
              <div class="col-12">
                <label class="form-label small">Pesan WhatsApp Auto-Order</label>
                <input type="text" name="item_whatsapp_text[]" class="form-control form-control-sm" value="<?= esc($item['whatsapp_text']) ?>" placeholder="Halo Zippy Store, saya mau klaim Flash Sale...">
              </div>
            </div>
          </div>
          <?php endfor; ?>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
          <button type="submit" class="btn btn-accent px-4 py-2">
            💾 Simpan Perubahan Flash Sale
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- SISI KANAN: PANDUAN & ATURAN FLASH SALE -->
  <div class="col-12 col-xl-4">
    <div class="zp-card p-4">
      <h3 class="h5 mb-3">📌 Panduan Jumbotron Promosi</h3>
      <div class="d-flex flex-column gap-3 small">
        <div class="p-3" style="background: #fef9c3; border: 2px solid #18181b; border-radius: 8px;">
          <div class="fw-bold mb-1">⏱️ Countdown Real-Time:</div>
          <div>Timer secara otomatis menghitung mundur sisa jam, menit, dan detik menuju waktu yang ditentukan. Saat habis, indikator akan berubah menjadi 00:00:00.</div>
        </div>
        <div class="p-3" style="background: #dcfce7; border: 2px solid #18181b; border-radius: 8px;">
          <div class="fw-bold mb-1">🏷️ Visual Chunky Pop:</div>
          <div>Warna latar kuning amber cerah, bayangan tegas hitam solid, dan progress bar slot tersisa yang memicu efek FOMO positif tanpa AI slop.</div>
        </div>
        <div class="p-3" style="background: #f3e8ff; border: 2px solid #18181b; border-radius: 8px;">
          <div class="fw-bold mb-1">💬 Direct Order WhatsApp:</div>
          <div>Ketika pembeli mengklik tombol klaim, template pesan langsung terisi dengan nama produk dan harga promo yang Anda atur di sini.</div>
        </div>
      </div>
      <a href="<?= site_url('/') ?>" target="_blank" class="btn btn-outline-accent w-100 mt-4">
        🔍 Pratinjau di Halaman Depan ↗
      </a>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
