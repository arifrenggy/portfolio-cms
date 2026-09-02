# Panduan Clone & Setup

## Persyaratan

- PHP ≥ 8.2 (ekstensi: `sqlite3`, `gd`, `intl`, `zip`, `mbstring`)
- Composer — [getcomposer.org](https://getcomposer.org)
- (Opsional) MySQL/MariaDB kalau tidak mau pakai SQLite

## 1. Clone Repository

```bash
git clone https://github.com/arifrenggy/portfolio-cms.git
cd portfolio-cms
```

## 2. Install Dependency

```bash
composer install
```

## 3. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

### Database

**Opsi A — SQLite (default, tanpa setup):** biarkan `.env` seperti ini:

```
DB_CONNECTION=sqlite
```

> File `database/database.sqlite` dibuat otomatis saat migrasi.

**Opsi B — MySQL:** sesuaikan `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio
DB_USERNAME=root
DB_PASSWORD=
```

Buat dulu database-nya: `mysql -u root -e "CREATE DATABASE portfolio;"`

## 4. Migrasi & Konten Awal

```bash
php artisan migrate --seed
php artisan storage:link
php artisan filament:assets
```

Perintah ini membuat semua tabel, akun admin awal, dan contoh konten (proyek, keahlian, section, menu).

## 5. Jalankan

```bash
php artisan serve
```

| Halaman | URL |
|---|---|
| Website publik | http://localhost:8000 |
| Panel admin | http://localhost:8000/admin |

### Login Admin Awal

| | |
|---|---|
| Email | `admin@example.com` |
| Password | `password` |

> ⚠️ **PENTING:** Segera ganti email & password setelah login pertama (klik nama Anda di kanan atas panel → **Profile**). Jangan pernah pakai kredensial default ini di produksi.

## 6. Verifikasi (Opsional)

```bash
php artisan test
```

Semua 7 test harus lolos: halaman publik, detail proyek, proteksi panel admin.

## Troubleshooting

| Masalah | Solusi |
|---|---|
| `could not find driver` | Aktifkan ekstensi `pdo_sqlite` di `php.ini` |
| Gambar tidak muncul | Jalankan ulang `php artisan storage:link` |
| Halaman admin kosong/styling rusak | Jalankan ulang `php artisan filament:assets` |
| `key:generate` gagal | Pastikan `.env` ada (langkah 3 belum dijalankan) |

## Deploy ke Produksi (Ringkas)

1. `composer install --optimize-autoloader --no-dev`
2. Set `.env` produksi: `APP_ENV=production`, `APP_DEBUG=false`, kredensial DB asli
3. `php artisan migrate --seed && php artisan storage:link && php artisan filament:assets`
4. Arahkan document root server (Nginx/Apache) ke folder `public/`
5. **Ganti kredensial admin default sebelum website bisa diakses orang lain**
