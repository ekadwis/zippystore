# PANDUAN DEPLOYMENT & HOSTING CPANEL: ZIPPY STORE (zippystore.my.id)
> Dokumentasi teknis resmi arsitektur folder hosting cPanel untuk Zippy Store (CodeIgniter 4).

---

## 1. STRUKTUR ARSITEKTUR DIREKTORI DI CPANEL

Untuk keamanan dan kepatuhan standar CodeIgniter 4, folder aplikasi (core) diletakkan di **luar** `public_html` agar file sistem dan `.env` tidak dapat diakses langsung oleh publik.

```text
/home/username_cpanel/
│
├── zippystore_app/            <-- SEMUA CORE APLIKASI DILETAKKAN DI SINI
│   ├── app/                   # Controllers, Models, Views, Config, Database, Libraries
│   ├── vendor/                # Composer dependencies
│   ├── writable/              # Cache, logs, upload session (Permission: 755 / 775)
│   ├── .env                   # Konfigurasi credentials production
│   ├── composer.json
│   ├── spark                  # CI4 CLI
│   └── ...
│
└── public_html/               <-- SEMUA ASSET PUBLIK DARI FOLDER [public/]
    ├── index.php              # Entry point utama (sudah diarahkan ke zippystore_app)
    ├── .htaccess              # Apache URL Rewrite
    ├── favicon.ico
    ├── favicon.png
    ├── robots.txt
    ├── css/
    ├── js/
    └── img/
```

---

## 2. PENYESUAIAN KODE ENTRY POINT (`public_html/index.php`)

Karena folder core bernama **`zippystore_app`**, baris path pada file `public_html/index.php` wajib disesuaikan sebagai berikut:

```php
// Path ke file Paths.php di dalam zippystore_app
require FCPATH . '../zippystore_app/app/Config/Paths.php';
```

---

## 3. KONFIGURASI FILE `.env` DI SERVER (`zippystore_app/.env`)

Pastikan nilai berikut terpasang di server production:

```ini
# ENVIRONMENT
CI_ENVIRONMENT = production

# BASE URL
app.baseURL = 'https://zippystore.my.id/'

# DATABASE CPANEL
database.default.hostname = localhost
database.default.database = namauser_namadb
database.default.username = namauser_dbuser
database.default.password = PasswordDatabaseKalian
database.default.DBDriver = MySQLi

# SMM PANEL (SPRINTPEDIA API)
SPRINTPEDIA_API_KEY = '7e1cd0-364b7a-dfbf8d-5fdf9e-bfca51'

# PAYMENT GATEWAY (DUITKU)
# Ganti ke 'production' dan gunakan API Key Production setelah KYC disetujui
DUITKU_ENV = 'sandbox'
DUITKU_API_KEY = '9bc46b1afc87611170d8921328e23c46'
DUITKU_MERCHANT_CODE = 'DS37725'

# TELEGRAM BOT & NOTIFIKASI
telegram.botToken = '8862434093:AAFg-Ph8Mo7dJgi0G26g6qJXQm2_km8Tj3E'
telegram.channelUsername = 'klddies'
telegram.channelId = '-1002082912790'
```

---

## 4. PERMISSION FOLDER WRITABLE

Pastikan direktori cache dan logs memiliki hak tulis:
- Path: `/home/username_cpanel/zippystore_app/writable/`
- Permission: **755** (atau **775** tergantung konfigurasi suPHP/FastCGI hosting).

---

## 5. UPDATE SKEMA DATABASE SAAT DEPLOY ULANG

Setiap kali melakukan update fitur (seperti tabel baru `sosmed_orders`, kolom baru, atau paket promo baru), jalankan perintah ini via menu **Terminal** di cPanel:

```bash
cd ~/zippystore_app
php spark migrate
php spark db:seed SosmedUpdateSeeder
php spark db:seed PromoNovemberSeeder
```

*Jika hosting tidak menyediakan akses SSH/Terminal, export tabel dari phpMyAdmin lokal dan import/sinkronkan ke phpMyAdmin cPanel.*

---

## 6. ENDPOINT WEBHOOK PAYMENT & CALLBACK

- **URL Callback Duitku**: `https://zippystore.my.id/callback` (atau `https://zippystore.my.id/payment/duitku-callback`)
- **URL Webhook Telegram**: `https://zippystore.my.id/webhook/telegram`
