<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Foreign key ke tabel categories
            $table->string('name'); // Nama produk (misal: Meja Makan Bundar)
            $table->text('description')->nullable(); // Deskripsi lengkap produk
            $table->string('wood_type')->nullable(); // Jenis kayu (misal: Jati, Mahoni)
            $table->string('dimensions')->nullable(); // Ukuran (misal: 120x80x75 cm)
            $table->string('finishing')->nullable(); // Jenis finishing (misal: Natural, Duco Putih)
            $table->string('main_image_path')->nullable(); // Path gambar utama produk
            // Jika ingin banyak gambar, Anda bisa membuat tabel terpisah (product_images)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
