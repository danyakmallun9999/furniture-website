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

            // Kolom-kolom baru yang ditambahkan:
            $table->string('product_type')->nullable(); // Jenis produk yang lebih spesifik (misal: Gebyok Ukiran Jepara)
            $table->string('motif')->nullable(); // Detail motif produk (misal: Ukiran Klasik Jawa - Flora dan Sulur)
            $table->unsignedBigInteger('price')->nullable(); // Harga produk (opsional, karena bisa kustomisasi)
            $table->text('short_description')->nullable(); // Deskripsi singkat produk
            $table->boolean('is_customizable')->default(false); // Apakah produk dapat dikustomisasi

            $table->text('description')->nullable(); // Deskripsi lengkap produk (sudah ada)
            $table->string('wood_type')->nullable(); // Jenis kayu (misal: Jati, Mahoni) (sudah ada)
            $table->string('dimensions')->nullable(); // Ukuran (misal: 120x80x75 cm) (sudah ada)
            $table->string('finishing')->nullable(); // Jenis finishing (misal: Natural, Duco Putih) (sudah ada)
            $table->string('main_image_path')->nullable(); // Path gambar utama produk (sudah ada)

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