### Manual Book Admin Dashboard

- Versi: 1.0
- Aplikasi: Furniture Website (Area Admin)
- Akses: Hanya pengguna terautentikasi dan terverifikasi

### Daftar Isi
- [Prasyarat & Akses](#prasyarat--akses)
- [Struktur Navigasi](#struktur-navigasi)
- [Dashboard Utama](#dashboard-utama)
- [Aksi Cepat di Dashboard](#aksi-cepat-di-dashboard)
- [Manajemen Kategori Produk](#manajemen-kategori-produk)
- [Manajemen Produk Mebel](#manajemen-produk-mebel)
- [Manajemen Transaksi (Invoice)](#manajemen-transaksi-invoice)
- [Laporan Keuangan](#laporan-keuangan)
- [Pengaturan Akun](#pengaturan-akun)
- [Tips, Validasi, dan Troubleshooting](#tips-validasi-dan-troubleshooting)

### Prasyarat & Akses
- **Login**: Masuk melalui halaman login, kemudian akses menu admin.
- **Hak akses**: Semua halaman admin dilindungi `auth` dan sebagian memerlukan `verified`. URL utama: `'/dashboard'`.
- **Sidebar**: Tersedia setelah login. Navigasi utama berada di sisi kiri layar.

### Struktur Navigasi
- **Dashboard**: `'/dashboard'` — Ringkasan keuangan dan grafik.
- **Kategori Produk**: `'/categories'` — Buat, ubah, hapus kategori.
- **Produk Mebel**: `'/products'` — Buat, ubah, hapus produk, kelola gambar.
- **Manajemen Transaksi**: `'/invoices'` — Buat transaksi (invoice), kelola status, unggah foto nota, cetak PDF.
- **Laporan Keuangan**: `'/reports/financial'` — Filter daftar transaksi, ekspor Excel/PDF, impor Excel.
- **Pengaturan Akun**: `'/profile'` — Ubah profil dan sandi.

### Dashboard Utama
Lokasi: `'/dashboard'`

- **Kartu Ringkasan (bulan ini)**
  - **Total Pemasukan**: Akumulasi `type = kredit` pada rentang bulan berjalan.
  - **Total Pengeluaran**: Akumulasi `type = debit` pada rentang bulan berjalan.
  - **Laba/Rugi Bersih**: Pemasukan − Pengeluaran. Lencana berubah warna sesuai hasil (untung/rugi).
- **Filter Grafik Transaksi**
  - Form GET di atas grafik:
    - **Granularitas** (`granularity`): `Bulanan (month)`, `Kuartal (quarter)`, `Tahunan (year)`.
    - **Tahun** (`year`): Pilih 10 tahun terakhir (default tahun berjalan).
    - Tombol **Terapkan** akan memuat ulang data dengan parameter terpilih.
  - **Grafik Batang**: Perbandingan Pemasukan vs Pengeluaran sepanjang label sumbu X sesuai granularitas.
  - **Unduh Grafik**: Tombol download di kanan judul kartu grafik untuk menyimpan PNG (`grafik-transaksi-<granularity>-<year>.png`).

### Aksi Cepat di Dashboard
Tersedia pada sidebar kanan dashboard:
- **Transaksi Baru**: ke `invoices.create` untuk membuat invoice baru.
- **Produk Baru**: ke `products.create` untuk menambah produk.
- **Laporan Keuangan**: ke `reports.financial` untuk analisis/ekspor/impor.
- **Kelola Transaksi**: ke `invoices.index` untuk daftar & aksi transaksi.

### Manajemen Kategori Produk
Lokasi: `'/categories'`

- **Daftar Kategori**: Tabel berisi nama dan deskripsi kategori.
- **Tambah Kategori**: `'/categories/create'`
  - Field: **Nama Kategori** (wajib, unik), **Deskripsi** (opsional).
  - Simpan menambah record dengan slug otomatis dari nama.
- **Edit Kategori**: `'/categories/{id}/edit'`
  - Field sama seperti tambah; slug otomatis diperbarui sesuai nama.
- **Hapus Kategori**: Tombol hapus pada baris tabel (konfirmasi terlebih dahulu).

### Manajemen Produk Mebel
Lokasi: `'/products'`

- **Daftar Produk**: Tabel menampilkan gambar utama, nama, kategori, jenis kayu, dimensi, harga, dan status custom.
- **Tambah Produk**: `'/products/create'`
  - Field utama:
    - **Kategori** (wajib)
    - **Nama Produk** (wajib)
    - **Jenis Produk** (opsional)
    - **Motif** (opsional)
    - **Harga** (opsional; kosong = harga custom)
    - **Produk dapat dikustomisasi** (checkbox)
    - **Jenis Kayu**, **Dimensi**, **Finishing** (semua opsional)
    - **Gambar Utama** (wajib; format: jpeg/png/jpg/gif/svg; maks 2MB)
    - **Gambar Tambahan** (opsional, multiple; format sama 2MB/berkas)
  - Setelah simpan: gambar utama disimpan di `storage/app/public/products`; gambar tambahan di `products/additional`.
- **Edit Produk**: `'/products/{id}/edit'`
  - Dapat mengganti gambar utama; gambar lama akan dihapus otomatis bila diganti.
  - Dapat menambah gambar tambahan dan menghapus gambar tambahan yang ada.
- **Hapus Produk**: Menghapus produk, gambar utama, dan semua gambar tambahan terkait dari penyimpanan.

### Manajemen Transaksi (Invoice)
Lokasi: `'/invoices'`

- **Daftar Transaksi**
  - Filter: **Tipe** (`kredit`/`debit`), **Dari Tanggal**, **Sampai Tanggal**, **Cari** (nomor/nama/totals).
  - Aksi per baris: **Lihat**, **Edit**, **Hapus** (dengan konfirmasi), pratinjau **Foto Nota** bila tersedia.
- **Buat Transaksi Baru**: `'/invoices/create'`
  - **Pelanggan**:
    - Pilih salah satu metode input: **Pelanggan Terdaftar** (dropdown) atau **Pelanggan Baru (Manual)** (nama teks).
  - **Detail Transaksi**: Nomor transaksi (default auto-suggest), tanggal transaksi, jatuh tempo (opsional), **Tipe** (`kredit`/`debit`), **Status Pembayaran** (`pending`/`paid`/`canceled`), **Catatan** (opsional), **Foto Nota** (opsional; jpeg/png/jpg/webp; maks 2MB).
  - **Item Transaksi**: Tambah satu atau lebih item; tiap item berisi Produk, Harga Satuan, Kuantitas. Subtotal dihitung otomatis. Total invoice dijumlahkan otomatis.
  - **Simpan**: Membuat invoice + item; bila pelanggan baru dipilih, sistem membuat entri pelanggan baru terlebih dahulu.
- **Lihat Detail**: `'/invoices/{id}'`
  - Menampilkan info transaksi, pelanggan, foto nota, daftar item, dan total.
  - Tombol **Download PDF**: `'/invoices/{id}/pdf'` (dibuka/diunduh via DomPDF).
- **Edit Transaksi**: `'/invoices/{id}/edit'`
  - Ubah semua field utama termasuk pelanggan (pilih terdaftar atau nama baru), status, tipe, tanggal, catatan.
  - Kelola item: tambah item baru, ubah item lama, hapus item yang tidak digunakan lagi. Total diperbarui otomatis.
  - Ganti **Foto Nota** (opsional). Jika diganti, gambar lama dihapus otomatis dari penyimpanan.
- **Hapus Transaksi**: Tombol di daftar transaksi dengan konfirmasi; menghapus invoice beserta item terkait.

### Laporan Keuangan
Lokasi: `'/reports/financial'`

- **Ringkasan**: Kartu Total Pemasukan, Total Pengeluaran, Laba/Rugi Bersih (dihitung dari filter aktif atau keseluruhan jika filter kosong).
- **Filter Daftar**: **Tipe**, **Dari Tanggal**, **Sampai Tanggal**, **Cari Nomor Transaksi**. Hasil ditampilkan terurut terbaru dan memiliki paginasi.
- **Ekspor**: `'/reports/financial/export'`
  - Pilih **Format**: `Excel (.xlsx)` atau `PDF (.pdf)`. Ekspor mengikuti filter yang sedang aktif.
- **Impor**: `'/reports/financial/import'`
  - Unggah file Excel (`.xlsx`, `.xls`, `.csv`; maks 4MB) dengan heading kolom berikut:
    - `invoice_number` (unik)
    - `invoice_date` (YYYY-MM-DD)
    - `due_date` (opsional, YYYY-MM-DD)
    - `type` (`kredit`/`debit`)
    - `total_amount` (angka)
    - `payment_status` (`pending`/`paid`/`canceled`)
    - `customer_name` (opsional)
    - `notes` (opsional)
  - Jika terjadi kesalahan validasi per baris, pesan error akan menampilkan baris dan detail error yang perlu diperbaiki.

### Pengaturan Akun
Lokasi: `'/profile'`
- Ubah informasi profil (nama, email) dan kata sandi.
- Tersedia dari menu **Pengaturan Akun** di sidebar.

### Tips, Validasi, dan Troubleshooting
- **Format Nominal**: Ditampilkan dalam Rupiah (`Rp`) dengan pemisah ribuan. Saat input angka, gunakan angka tanpa pemisah.
- **Tanggal**: Gunakan format `YYYY-MM-DD`. Tanggal jatuh tempo harus ≥ tanggal transaksi.
- **Tipe Transaksi**: `kredit` untuk pemasukan, `debit` untuk pengeluaran. Pastikan pilihan sesuai agar ringkasan & grafik akurat.
- **Status Pembayaran**: `pending`, `paid`, atau `canceled` — mempengaruhi tampilan lencana status.
- **Foto Nota**: Ukuran maks 2MB dan format yang diperbolehkan pada form. Saat edit, unggahan baru menggantikan file lama.
- **Nomor Transaksi**: Wajib unik. Jika impor, pastikan tidak duplikat.
- **Impor Gagal**: Cek pesan error — periksa heading kolom, tipe data, panjang maksimum string, dan format tanggal.
- **Tidak Ada Data**: Beberapa halaman menampilkan state kosong dan tombol tindakan untuk mulai menambah data.
- **Akses Ditolak**: Pastikan pengguna sudah login dan email terverifikasi.

### Referensi Rute & Aksi
- Dashboard: `GET /dashboard`
- Kategori: `GET /categories`, `GET /categories/create`, `POST /categories`, `GET /categories/{id}/edit`, `PUT /categories/{id}`, `DELETE /categories/{id}`
- Produk: `GET /products`, `GET /products/create`, `POST /products`, `GET /products/{id}/edit`, `PUT /products/{id}`, `DELETE /products/{id}`
- Transaksi: `GET /invoices`, `GET /invoices/create`, `POST /invoices`, `GET /invoices/{id}`, `GET /invoices/{id}/edit`, `PUT /invoices/{id}`, `DELETE /invoices/{id}`, `GET /invoices/{id}/pdf`
- Laporan Keuangan: `GET /reports/financial`, `GET /reports/financial/export?format=excel|pdf`, `GET /reports/financial/import`, `POST /reports/financial/import`

Catatan: Beberapa layar telah dilengkapi ikon dan animasi untuk pengalaman pengguna yang lebih baik. Gunakan sidebar untuk berpindah modul dengan cepat. Jika diperlukan, lihat folder `screenshots/` untuk referensi visual antarmuka (mis. `screenshots/admin/dashboard.png`, `screenshots/admin/invoice.png`, dll.). 