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
        'product_type', // Kolom baru
        'motif', // Kolom baru
        'price', // Kolom baru
        'short_description', // Kolom baru
        'is_customizable', // Kolom baru
        'description',
        'wood_type',
        'dimensions',
        'finishing',
        'main_image_path',
    ];

    /**
     * Get the category that owns the Product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}