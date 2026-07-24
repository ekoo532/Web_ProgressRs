# SIM-Dok RS (Laravel)

Versi Laravel dari aplikasi **SIM-Dok RS — Sistem Progress & ACC Dokumen**.
Fungsionalitas 1:1 dengan versi PHP native sebelumnya: login/registrasi,
upload dokumen, dan alur progress **otomatis** 25% → 50% → 75% → 100%
(Dokumen Masuk → Direview Admin → ACC Direktur → Selesai/Dikirim ke User).

## Struktur & pemetaan dari versi PHP native

| Versi PHP native | Versi Laravel |
|---|---|
| `config.php`, `includes/db.php` | `.env` + `config/database.php` |
| `includes/auth.php` | Laravel Auth bawaan (`Auth::attempt`, middleware `auth`, `guest`) |
| `includes/helpers.php` (`compute_progress`, `status_badge`) | `App\Models\Document` (`computedProgress()`, `statusLabel()`) + komponen Blade `<x-progress-bar>` / `<x-status-badge>` |
| `login.php` / `register.php` / `logout.php` | `App\Http\Controllers\AuthController` |
| `setup.php` (buat akun admin) | `database/seeders/DatabaseSeeder.php` → `php artisan db:seed` |
| `user/*.php` | `App\Http\Controllers\User\DocumentController` |
| `admin/*.php` | `App\Http\Controllers\Admin\*Controller` |
| `uploads/` (folder fisik) | `storage/app/public/documents` (diakses lewat `php artisan storage:link`) |
| `schema.sql` / `migrate.sql` | `database/migrations/*.php` (`php artisan migrate`) |
| `assets/style.css` | `public/css/style.css` (disalin apa adanya, tidak diubah) |

Middleware `role:admin` / `role:user` (`App\Http\Middleware\EnsureUserHasRole`)
menggantikan fungsi `require_role()`, dan progress tetap **selalu dihitung &
divalidasi di server** — tidak ada input manual/mentah dari client, sama
seperti versi asli.

## Instalasi (lokal maupun cPanel/hosting)

1. **Install dependency PHP:**
   ```bash
   composer install
   ```

2. **Siapkan file environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Edit `.env`, isi `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` sesuai
   database MySQL Anda (buat dulu database kosong di cPanel/phpMyAdmin,
   tidak perlu import `schema.sql` manual — migration akan membuat tabelnya).

3. **Jalankan migration** (membuat tabel `users`, `documents`, dll — pengganti `schema.sql`):
   ```bash
   php artisan migrate
   ```

4. **Buat akun admin default** (pengganti `setup.php`, username/password
   default `admin`/`admin`, bisa diubah lewat `SEED_ADMIN_USERNAME` &
   `SEED_ADMIN_PASSWORD` di `.env` sebelum menjalankan perintah ini):
   ```bash
   php artisan db:seed
   ```
   Segera ganti password admin setelah login pertama kali lewat menu
   **Kelola Pengguna**.

5. **Buat symlink storage** (agar file upload di `storage/app/public/documents`
   bisa diakses publik lewat `/storage/documents/...`, pengganti folder
   `uploads/` + `.htaccess` di versi lama):
   ```bash
   php artisan storage:link
   ```

6. **Set permission** folder `storage/` dan `bootstrap/cache/` agar bisa
   ditulisi oleh web server (mis. `755` atau `775` tergantung konfigurasi
   hosting).

7. **Arahkan document root** hosting/cPanel ke folder `public/` (bukan ke
   root project) — ini beda dengan versi PHP native yang sebelumnya taruh
   semua file langsung di `public_html`. Kalau tidak bisa mengubah document
   root, arahkan lewat subdomain/subfolder yang document root-nya folder
   `public/` ini.

8. **Jalankan aplikasi:**
   - Lokal: `php artisan serve` lalu buka `http://localhost:8000`
   - Hosting: pastikan `APP_URL` di `.env` sudah sesuai domain, lalu akses
     domain tersebut langsung (tanpa `/login.php`, cukup `/login`).

## Perbedaan penting dari versi PHP native

- Semua URL tanpa akhiran `.php` (mis. `/login`, `/user/dashboard`,
  `/admin/dashboard`) karena memakai routing Laravel, bukan file fisik.
- CSRF protection, validasi input, dan hashing password memakai mekanisme
  bawaan Laravel (fungsinya identik dengan `csrf_field()`/`verify_csrf()`
  dan `password_hash()` di versi lama).
- File upload disimpan di `storage/app/public/documents`, bukan folder
  `uploads/` di root — sudah otomatis terlindung dari eksekusi script
  karena berada di luar `public/`.
- Tidak perlu file `setup.php` yang harus dihapus manual setelah dipakai —
  cukup jalankan `php artisan db:seed` sekali (aman dijalankan berkali-kali,
  tidak akan membuat admin duplikat).
