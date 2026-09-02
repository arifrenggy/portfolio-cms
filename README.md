# Portfolio CMS — Laravel + Filament

Website portfolio pribadi dengan panel admin lengkap. Semua konten (hero, tentang, keahlian, proyek, kontak, menu, sosial media) dikelola dari panel admin Filament — tanpa perlu menyentuh kode.

## Fitur

- **Panel Admin** (`/admin`) — kelola semua konten dengan UI modern (Filament v5)
- **Pengaturan Situs** — nama, tagline, foto profil, tentang saya, kontak, sosial media, link CV
- **Section Halaman** — tambah/urutkan/sembunyikan section halaman publik (hero, tentang, keahlian, proyek, kontak, atau teks kustom)
- **Keahlian** — kartu keahlian dengan ikon & deskripsi, urutan bisa di-drag
- **Proyek** — judul, deskripsi, detail lengkap, gambar, tag teknologi, tautan demo, halaman detail per proyek (`/proyek/{slug}`)
- **Menu** — item menu navigasi dinamis, bisa diurutkan
- **Frontend publik** — tema gelap modern, responsif, animasi reveal on scroll, counter, navbar mobile

## Instalasi

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite   # atau atur MySQL di .env
php artisan migrate --seed       # membuat tabel + konto awal + user admin
php artisan storage:link
php artisan filament:assets
php artisan serve
```

Buka `http://localhost:8000` untuk website dan `http://localhost:8000/admin` untuk panel.

## Akun Admin Awal

| | |
|---|---|
| Email | `admin@example.com` |
| Password | `password` |

> ⚠️ **PENTING:** Segera ganti email & password ini setelah login pertama (klik nama Anda di kanan atas panel → Profile). Jangan gunakan kredensial default di produksi.

## Struktur Penting

```
app/Filament/Resources/     → Panel admin (Pengaturan, Section, Proyek, Keahlian, Menu)
app/Http/Controllers/SiteController.php   → Halaman publik
app/Models/                 → SiteSetting, Section, Project, Skill, MenuItem
database/migrations/        → Skema database
database/seeders/            → Konten awal
public/css/site.css          → Styling frontend
resources/views/site/        → Blade frontend (index, detail proyek)
routes/web.php               → Routing publik
```

## Deploy ke Produksi

1. Upload project ke server, jalankan `composer install --optimize-autoloader --no-dev`
2. Set `.env` production (DB, `APP_ENV=production`, `APP_DEBUG=false`)
3. `php artisan migrate --seed && php artisan storage:link && php artisan filament:assets`
4. Arahkan document root ke folder `public/`
5. Ganti kredensial admin default!

## Catatan Teknis

- Laravel 12, Filament v5, SQLite default (bisa diganti MySQL/PostgreSQL via `.env`)
- Akses panel dikontrol kolom `is_admin` pada tabel users — hanya user dengan `is_admin = true` yang bisa masuk
- Gambar disimpan di `storage/app/public` (diakses via symlink `public/storage`)
- Tests: `php artisan test` (7 test, mencakup halaman publik & proteksi panel)
- [Panduan Setup Lokal](SETUP.md) — clone, install, & konfigurasi
