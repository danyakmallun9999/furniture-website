<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'wood_type',
        'dimensions',
        'finishing',
        'main_image_path',
    ];

    // Definisi relasi: Satu produk dimiliki oleh satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
