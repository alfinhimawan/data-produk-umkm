# Data Produk UMKM

## 🌟 Deskripsi Proyek

Data Produk UMKM adalah aplikasi berbasis web yang dikembangkan menggunakan Laravel. Aplikasi ini dirancang untuk membantu pengelolaan data produk UMKM, termasuk fitur untuk admin dan pemilik UMKM.

### ✨ Fitur Utama
- **Dashboard Pemilik:**
  - Menampilkan informasi UMKM, termasuk logo UMKM.
  - Statistik produk UMKM.
  - Navigasi mudah untuk mengelola produk dan kategori.
- **Manajemen Admin:**
  - Melihat daftar UMKM yang terdaftar.
  - Menghapus UMKM yang tidak aktif.
  - Mengubah status UMKM (aktif/nonaktif).
- **Manajemen Produk:**
  - Pemilik UMKM dapat menambahkan, mengedit, dan menghapus produk.
  - Fitur pencarian produk untuk mempermudah navigasi.
- **Manajemen Kategori:**
  - Pemilik UMKM dapat mengelola kategori produk.
  - Kategori dapat ditambahkan, dihapus, dan diperbarui.
- **Profil UMKM:**
  - Pemilik dapat memperbarui profil UMKM, termasuk mengunggah logo.
  - Validasi ukuran logo dengan pesan error menggunakan SweetAlert.
- **Laporan Produk:**
  - Ekspor laporan produk UMKM ke format Excel.
  - Statistik penjualan produk.

## 🛠️ Persyaratan Sistem
- PHP >= 8.0
- Composer
- Node.js & npm
- Database MySQL

## 🚀 Instalasi

### Langkah-langkah Clone dan Setup
1. Clone repository:
   ```bash
   git clone <repository-url>
   ```

2. Masuk ke direktori proyek:
   ```bash
   cd data-produk-umkm
   ```

3. Install dependensi PHP:
   ```bash
   composer install
   ```

4. Install dependensi Node.js:
   ```bash
   npm install
   ```

5. Salin file `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```

6. Konfigurasi file `.env` sesuai dengan pengaturan database Anda.

7. Generate key aplikasi:
   ```bash
   php artisan key:generate
   ```

8. Migrasi database:
   ```bash
   php artisan migrate
   ```

9. Jalankan server lokal:
   ```bash
   php artisan serve
   ```

10. Buka aplikasi di browser:
    ```
    http://localhost:8000
    ```

## 🤝 Kontribusi

Terima kasih telah mempertimbangkan untuk berkontribusi pada proyek ini! Silakan buat pull request untuk perubahan yang ingin Anda tambahkan.

## 📜 Lisensi

Proyek ini menggunakan lisensi [MIT](https://opensource.org/licenses/MIT).
