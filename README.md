# Website E-Catalog Mebel Kayu Modern

![Homepage Screenshot](public/images/readme_homepage.png) {{-- Anda perlu membuat screenshot homepage dan simpan di public/images/ --}}

Website E-Catalog Mebel Kayu Modern adalah platform digital yang dirancang untuk industri mebel kayu, menampilkan produk-produk berkualitas tinggi dalam format katalog interaktif dan menyediakan sistem manajemen internal yang efisien. Proyek ini memadukan estetika desain yang modern dan minimalis dengan fungsionalitas yang kuat untuk mendukung operasional bisnis mebel.

---

## Daftar Isi

- [Fitur Utama](#fitur-utama)
- [Teknologi yang Digunakan](#teknologi-yang-digunakan)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Panduan Instalasi (Lokal)](#panduan-instalasi-lokal)
- [Penggunaan Aplikasi](#penggunaan-aplikasi)
- [Struktur Proyek](#struktur-proyek)
- [Pengembangan Selanjutnya](#pengembangan-selanjutnya)
- [Lisensi](#lisensi)

---

## Fitur Utama

### Area Publik (E-Catalog)

* **Homepage Interaktif:** Halaman beranda yang memukau dengan *hero section* modern, bagian fitur unggulan, narasi "Mengapa Memilih Kami", Call-to-Action, testimoni, dan blog terbaru, semuanya didesain secara visual.
* **Katalog Produk (E-Catalog):** Menampilkan daftar produk mebel dalam format *grid* yang rapi.
    * **Filter & Pencarian:** Filter produk berdasarkan kategori dan fitur pencarian yang responsif.
    * **Desain Kartu Produk Premium:** Tampilan kartu produk yang estetis dengan efek *hover* yang halus.
* **Halaman Detail Produk:** Menampilkan informasi lengkap produk, termasuk:
    * **Fleksibilitas Harga:** Mendukung tampilan harga numerik atau teks kustom (misal: "Mulai dari RpX", "Harga menyesuaikan permintaan").
    * **Detail Spesifikasi:** Informasi seperti Motif, Jenis Kayu, Dimensi, dan Finishing disajikan dalam tata letak yang terstruktur.
    * **Tombol WhatsApp Dinamis:** Tombol "Pesan Sekarang" dan "Konsultasi via WhatsApp" yang langsung terhubung dengan nomor bisnis, disertai pesan otomatis berisi detail produk.
    * **Produk Terkait:** Menampilkan rekomendasi produk serupa untuk mendorong eksplorasi lebih lanjut.
* **Halaman Informasi:** "Tentang Kami" dan "Kontak Kami" dengan desain modern dan informasi yang jelas.

### Area Admin (Sistem Manajemen Internal)

* **Sistem Autentikasi:** Fungsionalitas *Login* yang aman menggunakan Laravel Breeze (registrasi dinonaktifkan).
* **Dashboard Interaktif:** Menyajikan ringkasan keuangan bulanan (pemasukan, pengeluaran, laba/rugi bersih) dalam *cards* informatif dan grafik batang (Chart.js) untuk visualisasi tren.
* **Manajemen Kategori Produk (CRUD):** Memungkinkan admin untuk membuat, melihat, mengedit, dan menghapus kategori produk.
* **Manajemen Produk Mebel (CRUD):**
    * Mengelola detail produk lengkap, termasuk Motif, Harga Nominal/Catatan Harga, dan data lainnya.
    * Fitur unggah dan manajemen gambar produk.
* **Manajemen Transaksi Keuangan (CRUD):** Mencatat dan mengelola semua transaksi (kredit dan debit) dengan fitur filter dan pencarian.
* **Laporan Keuangan:**
    * Tampilan detail laporan keuangan yang dapat difilter.
    * Fungsionalitas **Ekspor data ke Excel**.
    * Fungsionalitas **Impor data dari Excel** (dengan validasi).
* **UI/UX Modern & Minimalis:** Seluruh antarmuka admin didesain ulang dengan skema warna terang, navigasi sidebar responsif dengan ikon, dan elemen-elemen yang bersih.

---

## Teknologi yang Digunakan

* **Backend:**
    * [PHP 8.2+](https://www.php.net/)
    * [Laravel 10.x](https://laravel.com/)
    * [MySQL 8.x+](https://www.mysql.com/) sebagai Database
    * [Composer](https://getcomposer.org/) (PHP Package Manager)
    * [Maatwebsite/Laravel-Excel](https://docs.laravel-excel.com/) (Untuk Ekspor/Impor Excel)
* **Frontend:**
    * [HTML5](https://html.spec.whatwg.org/multipage/)
    * [CSS3](https://www.w3.org/TR/css-2023/)
    * [Tailwind CSS 3.x](https://tailwindcss.com/) (Utility-first CSS Framework)
    * [JavaScript ES6+](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
    * [Alpine.js 3.x](https://alpinejs.dev/) (Minimalist JavaScript Framework)
    * [Chart.js 3.x](https://www.chartjs.org/) (Untuk Visualisasi Data)
    * [Vite](https://vitejs.dev/) (Frontend Build Tool, dikemas dalam Laravel `npm run dev/build`)
* **Version Control:**
    * [Git](https://git-scm.com/)

---

## Persyaratan Sistem

Pastikan Anda memiliki hal-hal berikut terinstal di sistem Anda:

* PHP 8.2 atau lebih tinggi.
* MySQL 8.0 atau lebih tinggi.
* Composer.
* Node.js (LTS direkomendasikan) & npm (atau Yarn).
* Git.
* Web server (Apache, Nginx, atau menggunakan `php artisan serve` bawaan Laravel).
* (Direkomendasikan: Laragon untuk Windows, atau Valet/Herd untuk macOS, atau XAMPP/LAMP/LEMP stack).

---

## Panduan Instalasi (Lokal)

Ikuti langkah-langkah ini untuk menjalankan proyek di lingkungan lokal Anda.

1.  **Clone Repositori:**
    ```bash
    git clone [https://github.com/your-username/furniture-website.git](https://github.com/your-username/furniture-website.git)
    cd furniture-website
    ```
    *(Ganti `https://github.com/your-username/furniture-website.git` dengan URL repositori Git Anda.)*

2.  **Instal Dependensi PHP:**
    ```bash
    composer install
    ```

3.  **Buat File Environment (.env):**
    ```bash
    cp .env.example .env
    ```

4.  **Atur Kunci Aplikasi:**
    ```bash
    php artisan key:generate
    ```

5.  **Konfigurasi Database:**
    * Buat database baru di MySQL (misal: `furniture_db`).
    * Buka file `.env` dan atur detail koneksi database Anda:
        ```env
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=furniture_db
        DB_USERNAME=root
        DB_PASSWORD=
        ```
        *(Sesuaikan `DB_USERNAME` dan `DB_PASSWORD` sesuai konfigurasi lokal Anda.)*

6.  **Jalankan Migrasi Database dan Seed Data:**
    ```bash
    php artisan migrate:fresh --seed
    ```
    * `migrate:fresh` akan menghapus semua tabel dan menjalankan ulang semua migrasi.
    * `--seed` akan menjalankan `DatabaseSeeder`, yang akan membuat akun admin awal.

7.  **Buat Symlink untuk Storage:**
    ```bash
    php artisan storage:link
    ```
    * Ini diperlukan agar gambar yang diunggah dapat diakses dari browser.

8.  **Instal Dependensi Node.js:**
    ```bash
    npm install
    ```

9.  **Kompilasi Aset Frontend:**
    * Untuk pengembangan (development):
        ```bash
        npm run dev
        ```
        *(Biarkan perintah ini berjalan di satu terminal selama pengembangan.)*
    * Untuk produksi (production build, setelah selesai develop):
        ```bash
        npm run build
        ```

10. **Jalankan Aplikasi:**
    ```bash
    php artisan serve
    ```
    * Aplikasi akan berjalan di `http://127.0.0.1:8000`.

---

## Penggunaan Aplikasi

### Area Publik (E-Catalog)

* Akses homepage di `http://127.0.0.1:8000`.
* Jelajahi produk di E-Catalog, gunakan filter dan pencarian.
* Lihat detail produk, spesifikasi, dan gunakan tombol WhatsApp untuk inkuiri.

### Area Admin

* Akses halaman login admin di `http://127.0.0.1:8000/login`.
* **Kredensial Login Default:**
    * **Email:** `admin@example.com`
    * **Password:** `password`
    *(Ini dibuat oleh `db:seed`.)*
* Setelah login, Anda akan masuk ke Dashboard Admin.
* Gunakan sidebar navigasi untuk mengelola Kategori, Produk, Transaksi, dan Laporan Keuangan.

---
