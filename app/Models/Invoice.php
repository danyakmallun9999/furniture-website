<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'user_id',
        'invoice_number',
        'invoice_date',
        'due_date',
        'total_amount',
        'payment_status',
        'notes',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'due_date' => 'date',
    ];

    // Relasi: Invoice dimiliki oleh satu Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relasi: Invoice dibuat oleh satu User (Admin)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Satu Invoice memiliki banyak InvoiceItem
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}