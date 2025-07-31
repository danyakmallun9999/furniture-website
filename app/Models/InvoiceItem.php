<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'product_id',
        'product_name_at_sale',
        'product_motif_at_sale',
        'quantity',
        'unit_price',
        'total_item_price',
    ];

    // Relasi: InvoiceItem dimiliki oleh satu Invoice
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    // Relasi: InvoiceItem mungkin terkait dengan satu Product (opsional)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}