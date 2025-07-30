# Website E-Catalog Mebel Kayu Modern

![Homepage Website Mebel Kayu](screenshots/readme_homepage.png)

Website E-Catalog Mebel Kayu Modern adalah platform digital yang dirancang untuk industri mebel kayu, menampilkan produk-produk berkualitas tinggi dalam format katalog interaktif dan menyediakan sistem manajemen internal yang efisien. Proyek ini memadukan estetika desain yang modern dan minimalis dengan fungsionalitas yang kuat untuk mendukung operasional bisnis mebel.

## 📋 Daftar Isi

- [🎯 Fitur Utama](#-fitur-utama)
- [🛠️ Teknologi yang Digunakan](#️-teknologi-yang-digunakan)
- [⚙️ Persyaratan Sistem](#️-persyaratan-sistem)
- [🚀 Panduan Instalasi](#-panduan-instalasi)
- [📱 Penggunaan Aplikasi](#-penggunaan-aplikasi)
- [📁 Struktur Proyek](#-struktur-proyek)
- [🔧 Konfigurasi](#-konfigurasi)
- [📸 Galeri & Screenshot](#-galeri--screenshot)
- [🔄 Pengembangan Selanjutnya](#-pengembangan-selanjutnya)
- [📄 Lisensi](#-lisensi)

---

## 🎯 Fitur Utama

### 🌐 Area Publik (E-Catalog)

#### Homepage Interaktif
- **Hero Section Modern:** Halaman beranda yang memukau dengan desain visual yang menarik
- **Fitur Unggulan:** Bagian yang menampilkan keunggulan produk dan layanan
- **Narasi "Mengapa Memilih Kami":** Penjelasan value proposition yang jelas
- **Call-to-Action:** Tombol-tombol yang mendorong interaksi pengguna
- **Testimoni & Blog:** Bagian untuk membangun kepercayaan dan engagement

#### Katalog Produk (E-Catalog)
- **Grid Layout Rapi:** Menampilkan daftar produk mebel dalam format yang terorganisir
- **Filter & Pencarian:** 
  - Filter produk berdasarkan kategori
  - Fitur pencarian yang responsif dan cepat
- **Desain Kartu Produk Premium:** 
  - Tampilan kartu produk yang estetis
  - Efek hover yang halus dan menarik

#### Halaman Detail Produk
- **Fleksibilitas Harga:** 
  - Mendukung tampilan harga numerik
  - Teks kustom (misal: "Mulai dari RpX", "Harga menyesuaikan permintaan")
- **Detail Spesifikasi Lengkap:**
  - Motif produk
  - Jenis Kayu
  - Dimensi
  - Finishing
  - Disajikan dalam tata letak yang terstruktur
- **Tombol WhatsApp Dinamis:**
  - Tombol "Pesan Sekarang" dan "Konsultasi via WhatsApp"
  - Terhubung langsung dengan nomor bisnis
  - Pesan otomatis berisi detail produk
- **Produk Terkait:** Rekomendasi produk serupa untuk mendorong eksplorasi

#### Halaman Informasi
- **Tentang Kami:** Informasi perusahaan dengan desain modern
- **Kontak Kami:** Informasi kontak yang jelas dan mudah diakses

### 🔐 Area Admin (Sistem Manajemen Internal)

#### Sistem Autentikasi
- **Login yang Aman:** Menggunakan Laravel Breeze
- **Registrasi Dinonaktifkan:** Untuk keamanan sistem

#### Dashboard Interaktif
- **Ringkasan Keuangan Bulanan:**
  - Pemasukan
  - Pengeluaran
  - Laba/rugi bersih
- **Cards Informatif:** Tampilan data yang mudah dibaca
- **Grafik Batang (Chart.js):** Visualisasi tren keuangan yang interaktif

#### Manajemen Konten
- **Manajemen Kategori Produk (CRUD):**
  - Membuat kategori baru
  - Melihat daftar kategori
  - Mengedit kategori
  - Menghapus kategori
- **Manajemen Produk Mebel (CRUD):**
  - Mengelola detail produk lengkap
  - Motif, Harga Nominal/Catatan Harga
  - Fitur unggah dan manajemen gambar produk

#### Manajemen Keuangan
- **Manajemen Transaksi (CRUD):**
  - Mencatat transaksi kredit dan debit
  - Fitur filter dan pencarian
  - Riwayat transaksi yang lengkap
- **Laporan Keuangan:**
  - Tampilan detail yang dapat difilter
  - **Ekspor data ke Excel**
  - **Impor data dari Excel** (dengan validasi)

#### UI/UX Modern & Minimalis
- **Skema Warna Terang:** Desain yang clean dan profesional
- **Navigasi Sidebar Responsif:** Dengan ikon yang intuitif
- **Elemen-elemen Bersih:** Fokus pada fungsionalitas

---

## 🛠️ Teknologi yang Digunakan

### Backend
- **[PHP 8.2+](https://www.php.net/)** - Bahasa pemrograman utama
- **[Laravel 10.x](https://laravel.com/)** - Framework PHP
- **[MySQL 8.x+](https://www.mysql.com/)** - Database
- **[Composer](https://getcomposer.org/)** - PHP Package Manager
- **[Maatwebsite/Laravel-Excel](https://docs.laravel-excel.com/)** - Ekspor/Impor Excel

### Frontend
- **[HTML5](https://html.spec.whatwg.org/multipage/)** - Markup
- **[CSS3](https://www.w3.org/TR/css-2023/)** - Styling
- **[Tailwind CSS 3.x](https://tailwindcss.com/)** - Utility-first CSS Framework
- **[JavaScript ES6+](https://developer.mozilla.org/en-US/docs/Web/JavaScript)** - Interaktivitas
- **[Alpine.js 3.x](https://alpinejs.dev/)** - Minimalist JavaScript Framework
- **[Chart.js 3.x](https://www.chartjs.org/)** - Visualisasi Data
- **[Vite](https://vitejs.dev/)** - Frontend Build Tool

### Version Control
- **[Git](https://git-scm.com/)** - Version control system

---

## ⚙️ Persyaratan Sistem

### Software yang Diperlukan
- **PHP 8.2** atau lebih tinggi
- **MySQL 8.0** atau lebih tinggi
- **Composer** - PHP package manager
- **Node.js (LTS)** & **npm** (atau Yarn)
- **Git** - Version control

### Web Server
- **Apache, Nginx**, atau menggunakan `php artisan serve` bawaan Laravel
- **Direkomendasikan:** 
  - Laragon untuk Windows
  - Valet/Herd untuk macOS
  - XAMPP/LAMP/LEMP stack

---

## 🚀 Panduan Instalasi

### 1. Clone Repositori
```bash
git clone https://github.com/your-username/furniture-website.git
cd furniture-website
```

### 2. Instal Dependensi PHP
```bash
composer install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database
1. Buat database baru di MySQL (misal: `furniture_db`)
2. Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=furniture_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Jalankan Migrasi dan Seed
```bash
php artisan migrate:fresh --seed
```

### 6. Setup Storage
```bash
php artisan storage:link
```

### 7. Instal Dependensi Node.js
```bash
npm install
```

### 8. Kompilasi Aset Frontend

#### Untuk Development
```bash
npm run dev
```
*(Biarkan perintah ini berjalan di terminal terpisah selama pengembangan)*

#### Untuk Production
```bash
npm run build
```

### 9. Jalankan Aplikasi
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://127.0.0.1:8000`

---

## 📱 Penggunaan Aplikasi

### 🌐 Area Publik (E-Catalog)

#### Akses Website
- **Homepage:** `http://127.0.0.1:8000`
- **Katalog:** Jelajahi produk dengan filter dan pencarian
- **Detail Produk:** Lihat spesifikasi dan gunakan tombol WhatsApp

#### Fitur Utama
- **Pencarian Produk:** Cari berdasarkan nama atau kategori
- **Filter Kategori:** Saring produk berdasarkan jenis
- **Detail Lengkap:** Spesifikasi, harga, dan gambar produk
- **WhatsApp Integration:** Hubungi langsung via WhatsApp

### 🔐 Area Admin

#### Login Admin
- **URL:** `http://127.0.0.1:8000/login`
- **Kredensial Default:**
  - **Email:** `admin@example.com`
  - **Password:** `password`

#### Fitur Admin
- **Dashboard:** Ringkasan keuangan dan grafik
- **Manajemen Kategori:** CRUD kategori produk
- **Manajemen Produk:** CRUD produk dengan gambar
- **Manajemen Transaksi:** Pencatatan keuangan
- **Laporan:** Ekspor/impor data Excel

---

## 🔧 Konfigurasi

### Konfigurasi WhatsApp

Website ini dilengkapi dengan fitur WhatsApp yang terintegrasi:

#### Fitur WhatsApp
- **Tombol WhatsApp Otomatis:** Setiap halaman detail produk
- **Pesan Otomatis:** Berisi nama produk yang sedang dilihat
- **Animasi Menarik:** Efek pulse dan hover
- **Konfigurasi Fleksibel:** Dapat diubah via `.env`

#### Format Pesan Otomatis
```
Halo, saya tertarik dengan produk [Nama Produk]. 
Mohon informasi lebih lanjut tentang harga dan ketersediaan. 
Terima kasih!
```

#### Cara Mengubah Nomor WhatsApp
1. Edit file `.env`
2. Ubah nilai `WHATSAPP_NUMBER=6281234567890`
3. Restart server Laravel jika diperlukan

### Konfigurasi Environment

Edit file `.env` dan sesuaikan konfigurasi berikut:

```env
# Konfigurasi WhatsApp
WHATSAPP_NUMBER=6281234567890

# Konfigurasi Kontak (Opsional)
CONTACT_EMAIL=info@furniture-website.com
CONTACT_PHONE=+62 812-3456-7890
CONTACT_ADDRESS_STREET=Jl. Contoh No. 123
CONTACT_ADDRESS_CITY=Jakarta
CONTACT_ADDRESS_POSTAL=12345
```

**Catatan:** Ganti `WHATSAPP_NUMBER` dengan nomor WhatsApp bisnis Anda (format: 6281234567890 tanpa tanda + atau spasi).

---

## 📁 Struktur Proyek

```
furniture-website/
├── app/
│   ├── Http/Controllers/     # Controller aplikasi
│   ├── Models/              # Model database
│   └── Helpers/             # Helper functions
├── resources/views/         # Blade templates
│   ├── admin/              # Views admin
│   ├── public/             # Views publik
│   └── components/         # Komponen reusable
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/           # Database seeders
├── routes/                 # Route definitions
├── public/                 # Public assets
└── storage/               # File uploads
```

---

## 📸 Galeri & Screenshot

Lihat [galeri lengkap screenshot proyek ini](screenshots.md) untuk mendapatkan gambaran visual dari berbagai fitur.

### Screenshot yang Tersedia
- Homepage
- Katalog Produk
- Detail Produk
- Halaman About
- Halaman Contact
- Dashboard Admin
- Manajemen Produk
- Laporan Keuangan

---

## 🔄 Pengembangan Selanjutnya

### Fitur yang Direncanakan
- [ ] Multi-language support
- [ ] Advanced search filters
- [ ] Product reviews & ratings
- [ ] Shopping cart functionality
- [ ] Payment gateway integration
- [ ] Mobile app development
- [ ] API for third-party integrations
- [ ] Advanced analytics dashboard

### Optimisasi yang Direncanakan
- [ ] Performance optimization
- [ ] SEO improvements
- [ ] Security enhancements
- [ ] Code refactoring
- [ ] Test coverage improvement

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

## 🤝 Kontribusi

Kontribusi selalu diterima! Silakan buat pull request atau buka issue untuk melaporkan bug atau menyarankan fitur baru.

## 📞 Support

Jika Anda mengalami masalah atau memiliki pertanyaan, silakan buat issue di repository ini atau hubungi tim pengembangan.

---

**Dibuat dengan ❤️ menggunakan Laravel dan Tailwind CSS**
