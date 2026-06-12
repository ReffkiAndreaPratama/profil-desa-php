# Panduan Deploy ke InfinityFree

## Langkah-langkah:

### 1. Persiapan Lokal

```bash
# Clone/copy folder ini
cd portal-desa-laravel

# Install dependencies
composer install --optimize-autoloader --no-dev

# Copy .env dan generate key
cp .env.example .env
php artisan key:generate
```

### 2. Buat Akun & Database di InfinityFree

1. Daftar di https://www.infinityfree.com
2. Buat hosting baru
3. Di Panel → MySQL → Create Database
4. Catat:
   - DB Host (biasanya: sql111.infinityfree.com atau sejenisnya)
   - DB Name (contoh: if0_38123456_portal_desa)
   - DB Username
   - DB Password

### 3. Konfigurasi .env

Edit file `.env`:
```
APP_NAME="Portal Desa Talang Marap"
APP_ENV=production
APP_DEBUG=false
APP_URL=http://portal-desa.infinityfreeapp.com

DB_HOST=sql111.infinityfree.com
DB_DATABASE=if0_38123456_portal_desa
DB_USERNAME=if0_38123456
DB_PASSWORD=password_kamu

ADMIN_EMAIL=admin@desatalangmarap.id
ADMIN_PASSWORD=admin123
```

### 4. Upload ke InfinityFree

**Menggunakan File Manager atau FTP:**

1. Upload SEMUA file ke folder `htdocs/` di hosting
2. Struktur di hosting:
   ```
   htdocs/
   ├── app/
   ├── bootstrap/
   ├── config/
   ├── database/
   ├── public/
   ├── resources/
   ├── routes/
   ├── storage/
   ├── vendor/
   ├── .env
   ├── .htaccess (redirect ke public/)
   ├── artisan
   └── composer.json
   ```

3. Buat folder yang diperlukan (jika belum ada):
   ```
   storage/framework/sessions/
   storage/framework/views/
   storage/framework/cache/data/
   storage/logs/
   ```

### 5. Jalankan Migrasi & Seeder

Karena InfinityFree tidak punya SSH, buka URL:
```
http://domain-kamu.infinityfreeapp.com/setup-install
```

Ini akan:
- Menjalankan migrasi database (buat semua tabel)
- Menjalankan seeder (isi data awal + akun admin)

Jika berhasil, muncul pesan hijau "✅ Instalasi berhasil!"

### 6. PENTING: Hapus Route Install

Setelah berhasil install, **HAPUS** baris berikut di `routes/web.php`:
```php
// Hapus semua baris dari Route::get('/setup-install'... sampai });
```

Atau biarkan saja - route itu otomatis tidak aktif lagi setelah file `storage/installed` terbuat.

### 7. Login Admin

Buka: `http://domain-kamu.infinityfreeapp.com/admin/login`

- Email: `admin@desatalangmarap.id`
- Password: `admin123`

**SEGERA UBAH PASSWORD setelah login pertama kali!**

---

## Troubleshooting

### Error 500
- Pastikan `storage/` folder writable (chmod 775)
- Pastikan `.env` file ada dan benar
- Cek `storage/logs/laravel.log`

### Blank Page
- Pastikan `.htaccess` di root redirect ke `public/`
- Pastikan `mod_rewrite` aktif

### Session Error
- Buat manual folder: `storage/framework/sessions/`
- Pastikan writable

### Mau Upload Gambar
- InfinityFree punya storage terbatas
- Gunakan URL gambar dari Unsplash, Imgur, atau hosting gambar lain
- Jangan upload file besar langsung

---

## Spesifikasi
- Laravel 10
- PHP 8.1+ (InfinityFree support 8.2)
- MySQL
- Blade + Tailwind CSS via CDN
- Session driver: file
- Cache driver: file
- Tidak memerlukan Redis/Node.js/npm
