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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Siapa admin yang mencatat transaksi
            $table->date('transaction_date'); // Tanggal transaksi
            $table->enum('type', ['kredit', 'debit']); // Tipe transaksi: pemasukan atau pengeluaran
            $table->decimal('amount', 15, 2); // Jumlah nominal (total 15 digit, 2 di belakang koma)
            $table->string('description'); // Deskripsi singkat transaksi
            // $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null'); // Opsional: jika ada kategori transaksi (misal: penjualan, gaji, bahan baku)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
