<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product; // Impor model Product
use App\Models\Category; // Impor model Category
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Impor Storage facade untuk file

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10); // Ambil produk dengan kategorinya, paginate
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori untuk dropdown
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'product_type' => 'nullable|string|max:255', // Validasi baru
            'motif' => 'nullable|string|max:255', // Validasi baru
            'price' => 'nullable|numeric|min:0', // Validasi baru (opsional, bisa nol atau positif)
            'short_description' => 'nullable|string', // Validasi baru
            'is_customizable' => 'boolean', // Validasi baru (akan otomatis dikonversi dari checkbox 0/1)
            'description' => 'nullable|string',
            'wood_type' => 'nullable|string|max:255',
            'dimensions' => 'nullable|string|max:255',
            'finishing' => 'nullable|string|max:255',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $imagePath = null;
        if ($request->hasFile('main_image')) {
            $imagePath = $request->file('main_image')->store('products', 'public');
        }
    
        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'product_type' => $request->product_type, // Simpan kolom baru
            'motif' => $request->motif, // Simpan kolom baru
            'price' => $request->price, // Simpan kolom baru
            'short_description' => $request->short_description, // Simpan kolom baru
            'is_customizable' => $request->has('is_customizable'), // Simpan kolom baru (true jika checkbox dicentang)
            'description' => $request->description,
            'wood_type' => $request->wood_type,
            'dimensions' => $request->dimensions,
            'finishing' => $request->finishing,
            'main_image_path' => $imagePath,
        ]);
    
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all(); // Ambil semua kategori untuk dropdown
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'product_type' => 'nullable|string|max:255', // Validasi baru
            'motif' => 'nullable|string|max:255', // Validasi baru
            'price' => 'nullable|numeric|min:0', // Validasi baru
            'short_description' => 'nullable|string', // Validasi baru
            'is_customizable' => 'boolean', // Validasi baru
            'description' => 'nullable|string',
            'wood_type' => 'nullable|string|max:255',
            'dimensions' => 'nullable|string|max:255',
            'finishing' => 'nullable|string|max:255',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $imagePath = $product->main_image_path;
        if ($request->hasFile('main_image')) {
            if ($product->main_image_path && Storage::disk('public')->exists($product->main_image_path)) {
                Storage::disk('public')->delete($product->main_image_path);
            }
            $imagePath = $request->file('main_image')->store('products', 'public');
        }
    
        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'product_type' => $request->product_type, // Perbarui kolom baru
            'motif' => $request->motif, // Perbarui kolom baru
            'price' => $request->price, // Perbarui kolom baru
            'short_description' => $request->short_description, // Perbarui kolom baru
            'is_customizable' => $request->has('is_customizable'), // Perbarui kolom baru
            'description' => $request->description,
            'wood_type' => $request->wood_type,
            'dimensions' => $request->dimensions,
            'finishing' => $request->finishing,
            'main_image_path' => $imagePath,
        ]);
    
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Hapus gambar dari storage
        if ($product->main_image_path && Storage::disk('public')->exists($product->main_image_path)) {
            Storage::disk('public')->delete($product->main_image_path);
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
