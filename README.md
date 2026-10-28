# Library App

Aplikasi Laravel sederhana untuk mengelola buku, peminjam, dan peminjaman.

## Persyaratan

- PHP 8.3 atau lebih baru
- Composer
- Ekstensi PHP `pdo_sqlite`

Database lokal menggunakan SQLite sehingga MySQL tidak perlu dijalankan. Node.js hanya diperlukan jika Anda ingin mengubah atau membangun ulang aset frontend.

## Menjalankan aplikasi

1. Buka terminal Laragon di folder proyek. Jika perintah `php` tidak ditemukan, pastikan direktori PHP Laragon sudah ditambahkan ke `PATH`.
2. Salin `.env.example` menjadi `.env` jika file `.env` belum ada.
3. Jalankan perintah berikut:

   ```powershell
   composer install
   php artisan key:generate
   php artisan migrate
   php artisan serve
   ```

4. Buka <http://127.0.0.1:8000>.

Jika PHP tersedia, tetapi Composer belum masuk `PATH`, proyek tetap dapat dijalankan dengan dependensi yang sudah ada:

```powershell
php artisan migrate
php artisan serve
```

Untuk mengubah aset CSS atau JavaScript, instal dependensi frontend dan jalankan Vite:

```powershell
npm install
npm run dev
```

## Pengujian

```powershell
php artisan test
```
