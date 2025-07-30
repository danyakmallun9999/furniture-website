<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Contact Information
    |--------------------------------------------------------------------------
    |
    | This file contains contact information for the furniture website
    | including WhatsApp number, email, and other contact details.
    |
    */

    'whatsapp' => [
        'number' => env('WHATSAPP_NUMBER', '6281234567890'),
        'message_template' => 'Halo, saya tertarik dengan produk {product_name}. Mohon informasi lebih lanjut tentang harga dan ketersediaan. Terima kasih!',
    ],

    'email' => [
        'address' => env('CONTACT_EMAIL', 'info@furniture-website.com'),
    ],

    'phone' => [
        'number' => env('CONTACT_PHONE', '+62 812-3456-7890'),
    ],

    'address' => [
        'street' => env('CONTACT_ADDRESS_STREET', 'Jl. Contoh No. 123'),
        'city' => env('CONTACT_ADDRESS_CITY', 'Jakarta'),
        'postal_code' => env('CONTACT_ADDRESS_POSTAL', '12345'),
    ],
]; 