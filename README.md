# Wengdev 2026

Proyek aplikasi web berbasis Laravel. Ikuti langkah-langkah di bawah ini untuk melakukan instalasi dan setup awal proyek.

## Prasyarat

Pastikan komputer sudah terinstal perangkat lunak berikut:

-   **PHP** (minimal versi 8.2)
-   **Composer**
-   **Git**

## Cara Instalasi (Clone & Seed)

Ikuti panduan langkah demi langkah berikut untuk menjalankan aplikasi:

1. **Clone Repositori**  
   Unduh source code proyek ini melalui git, kemudian masuk ke dalam foldernya:

    ```bash
    git clone https://github.com/diardomarendikrista/wengdev-2026.git
    cd wengdev-2026
    ```

2. **Install Dependensi**  
   Instal semua paket PHP yang dibutuhkan oleh proyek ini:

    ```bash
    composer install
    ```

3. **Setup File Konfigurasi (Environment)**  
   Duplikat file konfigurasi standar Laravel agar memiliki file `.env` sendiri:

    ```bash
    cp .env.example .env
    ```

    _(Jika menggunakan Windows dan command `cp` tidak jalan, bisa copy-paste file secara manual di File Explorer)._

4. **Generate Application Key**  
   Buat _app key_ unik untuk mengamankan session dan enkripsi data:

    ```bash
    php artisan key:generate
    ```

5. **Setup Database (Migrate & Seed)**  
   Proyek ini sudah dikonfigurasi untuk menggunakan SQLite. Cukup jalankan perintah di bawah ini untuk membuat seluruh tabel dan mengisinya dengan data awal secara otomatis (3 Kategori, 30 Artikel, dan puluhan Komentar acak):

    ```bash
    php artisan migrate:fresh --seed
    ```

6. **Menjalankan Aplikasi**

    **Opsi A: Tanpa Laravel Herd**  
    Jalankan _development server_ bawaan Laravel:

    ```bash
    php artisan serve
    ```

    Aplikasi dapat dibuka di browser melalui link: **[http://localhost:8000/articles](http://localhost:8000/articles)**

    **Opsi B: Menggunakan Laravel Herd**  
    Jika menggunakan [Laravel Herd](https://herd.laravel.com/), tidak perlu menjalankan `php artisan serve`. Pastikan menaruh folder proyek ini di dalam direktori yang sudah di-_park_ oleh Herd (misalnya folder `Herd`).

    Aplikasi secara otomatis sudah berjalan dan dapat diakses langsung melalui browser di:
    **[http://wengdev-2026.test/articles](http://wengdev-2026.test/articles)**
