# WhatsApp Integration Documentation

## Overview

Website furniture ini telah dilengkapi dengan fitur integrasi WhatsApp yang memungkinkan customer untuk langsung menghubungi bisnis melalui WhatsApp dengan pesan yang sudah disiapkan otomatis.

## Fitur Utama

### 1. Tombol WhatsApp di Halaman Detail Produk
- **Lokasi**: `resources/views/public/catalog/show.blade.php`
- **Fungsi**: Tombol "Minta Penawaran via WhatsApp" yang langsung mengarah ke WhatsApp
- **Pesan Otomatis**: Berisi nama produk yang sedang dilihat customer
- **Animasi**: Dilengkapi dengan animasi pulse dan efek hover yang menarik

### 2. Tombol WhatsApp di Halaman Contact
- **Lokasi**: `resources/views/public/contact/index.blade.php`
- **Fungsi**: Tombol "WhatsApp Kami" untuk pertanyaan umum
- **Pesan Otomatis**: Pesan umum untuk konsultasi

### 3. Konfigurasi Fleksibel
- **File Konfigurasi**: `config/contact.php`
- **Environment Variables**: Dapat diubah melalui file `.env`
- **Helper Class**: `app/Helpers/WhatsAppHelper.php`

## Konfigurasi

### 1. Setup Environment Variables

Tambahkan variabel berikut ke file `.env`:

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

### 2. Format Nomor WhatsApp
- **Format**: `6281234567890` (tanpa tanda + atau spasi)
- **Contoh**: `6281234567890` untuk nomor +62 812-3456-7890

### 3. Template Pesan

Pesan otomatis dapat dikustomisasi di `config/contact.php`:

```php
'whatsapp' => [
    'number' => env('WHATSAPP_NUMBER', '6281234567890'),
    'message_template' => 'Halo, saya tertarik dengan produk {product_name}. Mohon informasi lebih lanjut tentang harga dan ketersediaan. Terima kasih!',
],
```

## Struktur Kode

### 1. Helper Class (`app/Helpers/WhatsAppHelper.php`)

```php
// Generate URL untuk produk spesifik
WhatsAppHelper::generateUrl($productName);

// Generate URL untuk pertanyaan umum
WhatsAppHelper::generateGeneralUrl($message);

// Cek apakah WhatsApp sudah dikonfigurasi
WhatsAppHelper::isConfigured();

// Dapatkan nomor yang sudah diformat
WhatsAppHelper::getFormattedNumber();
```

### 2. Konfigurasi (`config/contact.php`)

```php
return [
    'whatsapp' => [
        'number' => env('WHATSAPP_NUMBER', '6281234567890'),
        'message_template' => 'Halo, saya tertarik dengan produk {product_name}. Mohon informasi lebih lanjut tentang harga dan ketersediaan. Terima kasih!',
    ],
    // ... konfigurasi lainnya
];
```

## Implementasi di View

### 1. Halaman Detail Produk

```php
@php
    use App\Helpers\WhatsAppHelper;
    $whatsappUrl = WhatsAppHelper::generateUrl($product->name);
    $isWhatsAppConfigured = WhatsAppHelper::isConfigured();
@endphp

@if($isWhatsAppConfigured)
    <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" class="whatsapp-button">
        <svg>...</svg>
        <span>Minta Penawaran via WhatsApp</span>
    </a>
@else
    <div class="cursor-not-allowed">
        WhatsApp Belum Dikonfigurasi
    </div>
@endif
```

### 2. Halaman Contact

```php
@php
    use App\Helpers\WhatsAppHelper;
    $whatsappNumber = WhatsAppHelper::getFormattedNumber();
    $isWhatsAppConfigured = WhatsAppHelper::isConfigured();
@endphp

@if($isWhatsAppConfigured)
    <a href="{{ WhatsAppHelper::generateGeneralUrl() }}" target="_blank">
        <svg>...</svg>
        <span>WhatsApp Kami</span>
    </a>
@endif
```

## Animasi dan Styling

### 1. CSS Animasi

```css
@keyframes whatsapp-pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.whatsapp-button {
    animation: whatsapp-pulse 2s infinite;
}

.whatsapp-button:hover {
    animation: none;
}
```

### 2. Tailwind Classes

```html
class="whatsapp-button group inline-flex items-center justify-center px-6 py-2.5 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl"
```

## Keamanan

### 1. Target Blank
- Semua link WhatsApp menggunakan `target="_blank"`
- Menambahkan `rel="noopener noreferrer"` untuk keamanan

### 2. URL Encoding
- Pesan di-encode menggunakan `urlencode()` untuk menghindari karakter khusus

### 3. Validasi Konfigurasi
- Mengecek apakah nomor WhatsApp sudah dikonfigurasi dengan benar
- Menampilkan pesan error jika belum dikonfigurasi

## Troubleshooting

### 1. WhatsApp Tidak Muncul
- Pastikan `WHATSAPP_NUMBER` sudah diset di file `.env`
- Pastikan format nomor benar (6281234567890)
- Restart server Laravel jika diperlukan

### 2. Pesan Tidak Terisi Otomatis
- Periksa template pesan di `config/contact.php`
- Pastikan placeholder `{product_name}` ada di template

### 3. Link Tidak Bekerja
- Pastikan nomor WhatsApp valid
- Cek apakah ada karakter khusus di pesan yang perlu di-encode

## Pengembangan Selanjutnya

### 1. Fitur yang Bisa Ditambahkan
- [ ] Tracking analytics untuk klik WhatsApp
- [ ] Multiple nomor WhatsApp (untuk tim sales)
- [ ] Pesan kustom berdasarkan kategori produk
- [ ] Integrasi dengan CRM
- [ ] Auto-reply bot

### 2. Optimasi
- [ ] Lazy loading untuk icon WhatsApp
- [ ] Progressive Web App (PWA) untuk akses cepat
- [ ] Offline fallback

## Support

Jika ada pertanyaan atau masalah dengan integrasi WhatsApp, silakan hubungi tim development atau buat issue di repository. 