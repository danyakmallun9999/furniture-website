<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product; // Impor model Product
use App\Models\Category; // Impor model Category
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Impor Storage facade untuk file
use App\Models\ProductImage;

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
            'product_type' => 'nullable|string|max:255',
            'motif' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'short_description' => 'nullable|string',
            'is_customizable' => 'boolean',
            'description' => 'nullable|string',
            'wood_type' => 'nullable|string|max:255',
            'dimensions' => 'nullable|string|max:255',
            'finishing' => 'nullable|string|max:255',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Gambar utama wajib
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi untuk multiple files
        ]);

        $mainImagePath = null;
        if ($request->hasFile('main_image')) {
            $mainImagePath = $request->file('main_image')->store('products', 'public');
        }

        // Buat produk terlebih dahulu untuk mendapatkan ID-nya
        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'product_type' => $request->product_type,
            'motif' => $request->motif,
            'price' => $request->price,
            'short_description' => $request->short_description,
            'is_customizable' => $request->has('is_customizable'),
            'description' => $request->description,
            'wood_type' => $request->wood_type,
            'dimensions' => $request->dimensions,
            'finishing' => $request->finishing,
            'main_image_path' => $mainImagePath,
        ]);

        // Tangani upload gambar tambahan
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                $imagePath = $image->store('products/additional', 'public'); // Simpan di sub-folder
                $product->images()->create([ // Gunakan relasi untuk menyimpan gambar
                    'image_path' => $imagePath,
                ]);
            }
        }

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
            'product_type' => 'nullable|string|max:255',
            'motif' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'short_description' => 'nullable|string',
            'is_customizable' => 'boolean',
            'description' => 'nullable|string',
            'wood_type' => 'nullable|string|max:255',
            'dimensions' => 'nullable|string|max:255',
            'finishing' => 'nullable|string|max:255',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Gambar utama opsional saat update
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi untuk multiple files
            'existing_images_to_delete' => 'nullable|array', // Untuk menghapus gambar yang sudah ada
            'existing_images_to_delete.*' => 'exists:product_images,id', // Pastikan ID gambar yang akan dihapus itu valid
        ]);

        $mainImagePath = $product->main_image_path;
        if ($request->hasFile('main_image')) {
            // Hapus gambar utama lama jika ada
            if ($product->main_image_path && Storage::disk('public')->exists($product->main_image_path)) {
                Storage::disk('public')->delete($product->main_image_path);
            }
            // Simpan gambar utama baru
            $mainImagePath = $request->file('main_image')->store('products', 'public');
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'product_type' => $request->product_type,
            'motif' => $request->motif,
            'price' => $request->price,
            'short_description' => $request->short_description,
            'is_customizable' => $request->has('is_customizable'),
            'description' => $request->description,
            'wood_type' => $request->wood_type,
            'dimensions' => $request->dimensions,
            'finishing' => $request->finishing,
            'main_image_path' => $mainImagePath,
        ]);

        // Tangani penghapusan gambar tambahan yang sudah ada
        if ($request->has('existing_images_to_delete')) {
            $imagesToDelete = ProductImage::whereIn('id', $request->existing_images_to_delete)->get();
            foreach ($imagesToDelete as $image) {
                if (Storage::disk('public')->exists($image->image_path)) {
                    Storage::disk('public')->delete($image->image_path);
                }
                $image->delete();
            }
        }

        // Tangani upload gambar tambahan baru
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                $imagePath = $image->store('products/additional', 'public');
                $product->images()->create([
                    'image_path' => $imagePath,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Hapus gambar utama dari storage
        if ($product->main_image_path && Storage::disk('public')->exists($product->main_image_path)) {
            Storage::disk('public')->delete($product->main_image_path);
        }

        // Hapus semua gambar tambahan dari storage dan database
        foreach ($product->images as $image) {
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
            $image->delete(); // Hapus entri dari tabel product_images
        }

        $product->delete(); // Hapus produk itu sendiri
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
