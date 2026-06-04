# 🛒 Zippy Store

> Website toko digital multi-layanan — **Solusi Digital Termudah & Termurah!**

Zippy Store adalah website katalog toko digital yang menjual berbagai layanan: **Joki Tugas**, **App Premium**, **Sosmed Boost**, dan **Nomor OTP**. Semua transaksi diarahkan ke WhatsApp admin (tanpa payment gateway). Dilengkapi dashboard admin untuk mengelola seluruh konten.

![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4-EF4223?logo=codeigniter&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-phpMyAdmin-4479A1?logo=mysql&logoColor=white)

---

## ✨ Fitur

### Sisi Pengunjung
- 🏠 **Landing page** — hero, daftar layanan, statistik, cara pesan, promo, client
- 📝 **Joki Tugas** — form pemesanan langsung terkirim ke WhatsApp dengan format rapi
- 🎬 **App Premium** — katalog akun premium (Netflix, Spotify, YouTube, dll) dengan pilihan durasi
- 🚀 **Sosmed Boost** — kalkulator harga custom (hitung sendiri jumlah yang diinginkan) + daftar paket
- 📱 **Nomor OTP** — daftar harga sewa nomor OTP berbagai aplikasi
- 💬 **Testimonials** — galeri foto testimoni + integrasi Telegram
- 🖼️ **Gallery** — galeri masonry dengan search & filter kategori
- 📋 **Cara Pesan** — panduan pemesanan + statistik pencapaian

### Sisi Admin (Dashboard)
- 🔒 Login admin terproteksi (session + filter auth)
- 🛠️ **CRUD lengkap** untuk semua modul: Sosmed Boost, App Premium, Nomor OTP, Testimoni, Galeri, Statistik, Client, Promo
- ⚙️ Halaman **Pengaturan** untuk mengatur info toko, kontak, sosial media, logo & favicon
- 🧮 Kalkulator harga Sosmed Boost di dashboard

---

## 🧰 Tech Stack

| Komponen | Teknologi |
|----------|-----------|
| Framework | CodeIgniter 4 |
| Bahasa | PHP 8.1+ |
| Database | MySQL (phpMyAdmin) |
| Front-end | Bootstrap 5.3.3 (CDN) |
| Font | Inter (Google Fonts) |
| Tema | Dark mode, accent ungu-biru |

---

## 🚀 Instalasi

### Prasyarat
- PHP 8.1 atau lebih baru
- Composer
- MySQL / MariaDB (phpMyAdmin)

### Langkah

```bash
# 1. Clone repository
git clone https://github.com/USERNAME/zippystore.git
cd zippystore

# 2. Install dependency
composer install

# 3. Salin file environment
cp env .env
```

Edit file `.env`, sesuaikan baris berikut:

```dotenv
CI_ENVIRONMENT = development

app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = zippystore
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

```bash
# 4. Buat database bernama "zippystore" di phpMyAdmin,
#    lalu import file SQL (lihat folder /database atau jalankan query manual)

# 5. Jalankan server lokal
php spark serve
```

Buka browser ke **http://localhost:8080**

---

## 🔑 Akses Admin

Dashboard admin ada di **`/login`** lalu diarahkan ke **`/admin/sosmed`**.

Untuk membuat akun admin, generate hash password lalu masukkan ke tabel `admin`:

```bash
php -r "echo password_hash('passwordmu', PASSWORD_DEFAULT);"
```

```sql
INSERT INTO admin (username, password) VALUES ('admin', '<<HASH_HASIL_DI_ATAS>>');
```

---

## ⚙️ Konfigurasi Awal (Penting!)

Setelah instalasi, login ke dashboard dan lakukan:

1. **Buka `/admin/pengaturan`** — isi nama toko, nomor WhatsApp, email, link sosial media, logo & favicon. Nomor WhatsApp di sini dipakai oleh semua tombol "Order" di seluruh situs.
2. **Isi data konten** lewat dashboard: testimoni, galeri, client, promo, statistik.
3. **Lengkapi harga** App Premium (Spotify & YouTube masih placeholder) dan tambah produk OTP sesuai kebutuhan.

> 💡 **Penyimpanan gambar:** semua gambar (testimoni, galeri, logo) menggunakan **URL online** (mis. [postimg](https://postimages.org/), Cloudinary, imgbb), bukan upload ke server — untuk menghemat kuota disk hosting. Cukup tempel URL gambar di form admin.

---

## 📁 Struktur Folder

```
app/
├── Config/         # Routes, Filters, Database
├── Controllers/    # Controller publik
│   └── Admin/      # Controller dashboard admin
├── Filters/        # AuthFilter (proteksi admin)
├── Helpers/        # sosmed_helper (rumus harga)
├── Models/         # Model untuk tiap tabel
└── Views/
    ├── template/   # header & footer
    ├── ...         # view publik
    └── admin/      # view dashboard
public/
├── css/            # style.css (publik), admin-sosmed.css (admin)
└── js/             # script.js
```

---

## 📚 Dokumentasi

Spesifikasi lengkap (database, modul, routing, business logic, konvensi) tersedia di dokumen **PRD Final** project ini. Sangat disarankan dibaca sebelum melakukan pengembangan lebih lanjut.

---

## 📝 Lisensi

Project ini dibuat untuk keperluan Zippy Store. Seluruh hak cipta dimiliki oleh pemilik toko.

---

<p align="center">Dibuat dengan ❤️ untuk Zippy Store</p>
