<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',          // ID admin yang mencatat
        'transaction_date', // Tanggal transaksi
        'type',             // 'kredit' atau 'debit'
        'amount',           // Jumlah nominal
        'description',      // Deskripsi transaksi
    ];

    protected $casts = [
        'transaction_date' => 'date', // Mengubah kolom ini menjadi objek Carbon otomatis
    ];

    // Relasi: Transaksi ini dicatat oleh satu user (admin)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
