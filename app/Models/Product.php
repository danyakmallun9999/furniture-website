<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'name',
        'product_type',
        'motif',
        'price',
        'short_description',
        'is_customizable',
        'description',
        'wood_type',
        'dimensions',
        'finishing',
        'main_image_path', // Ini masih kita pertahankan untuk gambar utama
    ];

    /**
     * Get the category that owns the Product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the images for the product.
     * Ini adalah relasi baru untuk multiple images.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}