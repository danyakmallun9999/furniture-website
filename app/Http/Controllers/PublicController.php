<?php

namespace App\Http\Controllers;

use App\Models\Product; // Impor model Product
use App\Models\Category; // Impor model Category
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Display the homepage.
     */
    public function homepage()
    {
        // Ambil beberapa produk terbaru atau unggulan untuk homepage
        $latestProducts = Product::with('category')->latest()->limit(8)->get();
        $categories = Category::all(); // Untuk filter/navigasi kategori di homepage
        return view('public.homepage', compact('latestProducts', 'categories'));
    }

    /**
     * Display the E-Catalog.
     */
    public function catalog(Request $request)
    {
        $categoryId = $request->input('category');
        $search = $request->input('search');

        $products = Product::with('category')
            ->when($categoryId, function ($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%')
                      ->orWhere('wood_type', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate(9); // Tampilkan 9 produk per halaman

        $categories = Category::all(); // Untuk filter kategori di katalog

        return view('public.catalog.index', compact('products', 'categories', 'categoryId', 'search'));
    }

    /**
     * Display a specific product detail.
     */
    public function productDetail(Product $product)
    {
        return view('public.catalog.show', compact('product'));
    }

    /**
     * Display About Us page.
     */
    public function about()
    {
        return view('public.about.index');
    }

    /**
     * Display Contact Us page.
     */
    public function contact()
    {
        return view('public.contact.index');
    }
}
