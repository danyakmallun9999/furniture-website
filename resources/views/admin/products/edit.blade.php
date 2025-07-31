{{-- resources/views/admin/products/edit.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center space-x-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white leading-tight">
                        Edit Produk Mebel - {{ $product->name }}
                    </h2>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                        Perbarui informasi produk yang ada
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Main Content Card --}}
            <div class="group relative">
                <div class="absolute inset-0 bg-slate-100 dark:bg-slate-800 rounded-2xl opacity-75 group-hover:opacity-100 blur-sm group-hover:blur-none transition-all duration-300"></div>
                <div class="relative bg-white dark:bg-slate-900 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 border border-slate-200 dark:border-slate-700">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Header Section --}}
                        <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-amber-500 to-orange-600 rounded-xl flex items-center justify-center">
                                    <i data-lucide="edit-3" class="w-5 h-5 text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Edit Produk #{{ $product->id }}</h3>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">Perbarui informasi produk</p>
                                </div>
                            </div>
                        </div>

                        {{-- Form Section --}}
                        <div class="p-6">
                            {{-- Basic Information --}}
                            <div class="mb-8">
                                <h4 class="text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center">
                                    <i data-lucide="info" class="w-5 h-5 mr-2 text-blue-500"></i>
                                    Informasi Dasar
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- Category --}}
                                    <div>
                                        <label for="category_id" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="folder" class="w-4 h-4 text-blue-500"></i>
                                                <span>Kategori Produk</span>
                                            </div>
                                        </label>
                                        <select id="category_id" name="category_id"
                                            class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                            required>
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    {{-- Product Name --}}
                                    <div>
                                        <label for="name" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="package" class="w-4 h-4 text-blue-500"></i>
                                                <span>Nama Produk</span>
                                            </div>
                                        </label>
                                        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}"
                                            class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                            placeholder="Masukkan nama produk" required autofocus>
                                        @error('name')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    {{-- Product Type --}}
                                    <div>
                                        <label for="product_type" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="tag" class="w-4 h-4 text-blue-500"></i>
                                                <span>Jenis Produk (Opsional)</span>
                                            </div>
                                        </label>
                                        <input type="text" id="product_type" name="product_type" value="{{ old('product_type', $product->product_type) }}"
                                            class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                            placeholder="misal: Gebyok Ukiran Jepara">
                                        @error('product_type')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    {{-- Motif --}}
                                    <div>
                                        <label for="motif" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="palette" class="w-4 h-4 text-blue-500"></i>
                                                <span>Motif (Opsional)</span>
                                            </div>
                                        </label>
                                        <input type="text" id="motif" name="motif" value="{{ old('motif', $product->motif) }}"
                                            class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                            placeholder="misal: Ukiran Klasik Jawa - Flora dan Sulur">
                                        @error('motif')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Pricing & Customization --}}
                            <div class="mb-8">
                                <h4 class="text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center">
                                    <i data-lucide="dollar-sign" class="w-5 h-5 mr-2 text-blue-500"></i>
                                    Harga & Kustomisasi
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- Price --}}
                                    <div>
                                        <label for="price" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="dollar-sign" class="w-4 h-4 text-blue-500"></i>
                                                <span>Harga (Opsional)</span>
                                            </div>
                                        </label>
                                        <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}"
                                            class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                            placeholder="misal: 30000000 untuk Rp30.000.000" min="0">
                                        @error('price')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    {{-- Customizable Checkbox --}}
                                    <div class="flex items-center justify-center">
                                        <label for="is_customizable" class="flex items-center p-4 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-600 cursor-pointer hover:bg-slate-100 dark:hover:bg-slate-700/50 transition-colors">
                                            <input type="checkbox" id="is_customizable" name="is_customizable" value="1"
                                                {{ old('is_customizable', $product->is_customizable) ? 'checked' : '' }}
                                                class="w-4 h-4 text-blue-600 bg-slate-100 border-slate-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-slate-800 focus:ring-2 dark:bg-slate-700 dark:border-slate-600">
                                            <span class="ml-3 text-sm text-slate-700 dark:text-slate-300">
                                                <i data-lucide="settings" class="w-4 h-4 inline mr-1"></i>
                                                Produk dapat dikustomisasi
                                            </span>
                                        </label>
                                        @error('is_customizable')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Specifications --}}
                            <div class="mb-8">
                                <h4 class="text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center">
                                    <i data-lucide="ruler" class="w-5 h-5 mr-2 text-blue-500"></i>
                                    Spesifikasi
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    {{-- Wood Type --}}
                                    <div>
                                        <label for="wood_type" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="tree" class="w-4 h-4 text-blue-500"></i>
                                                <span>Jenis Kayu (Opsional)</span>
                                            </div>
                                        </label>
                                        <input type="text" id="wood_type" name="wood_type" value="{{ old('wood_type', $product->wood_type) }}"
                                            class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                            placeholder="misal: Jati, Mahoni, dll">
                                        @error('wood_type')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    {{-- Dimensions --}}
                                    <div>
                                        <label for="dimensions" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="ruler" class="w-4 h-4 text-blue-500"></i>
                                                <span>Dimensi (Opsional)</span>
                                            </div>
                                        </label>
                                        <input type="text" id="dimensions" name="dimensions" value="{{ old('dimensions', $product->dimensions) }}"
                                            class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                            placeholder="misal: P120 x L80 x T75 cm">
                                        @error('dimensions')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    {{-- Finishing --}}
                                    <div>
                                        <label for="finishing" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="brush" class="w-4 h-4 text-blue-500"></i>
                                                <span>Finishing (Opsional)</span>
                                            </div>
                                        </label>
                                        <input type="text" id="finishing" name="finishing" value="{{ old('finishing', $product->finishing) }}"
                                            class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                            placeholder="misal: Natural, Melamik, dll">
                                        @error('finishing')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Descriptions --}}
                            <div class="mb-8">
                                <h4 class="text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center">
                                    <i data-lucide="file-text" class="w-5 h-5 mr-2 text-blue-500"></i>
                                    Deskripsi
                                </h4>
                                <div class="space-y-6">
                                    {{-- Short Description --}}
                                    <div>
                                        <label for="short_description" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="file-text" class="w-4 h-4 text-blue-500"></i>
                                                <span>Deskripsi Singkat (Opsional)</span>
                                            </div>
                                        </label>
                                        <textarea id="short_description" name="short_description" rows="3"
                                            class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none"
                                            placeholder="Deskripsi singkat produk">{{ old('short_description', $product->short_description) }}</textarea>
                                        @error('short_description')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    {{-- Full Description --}}
                                    <div>
                                        <label for="description" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="file-text" class="w-4 h-4 text-blue-500"></i>
                                                <span>Deskripsi Lengkap (Opsional)</span>
                                            </div>
                                        </label>
                                        <textarea id="description" name="description" rows="5"
                                            class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none"
                                            placeholder="Deskripsi lengkap produk">{{ old('description', $product->description) }}</textarea>
                                        @error('description')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Image Upload --}}
                            <div class="mb-8">
                                <h4 class="text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center">
                                    <i data-lucide="image" class="w-5 h-5 mr-2 text-blue-500"></i>
                                    Gambar Produk
                                </h4>
                                <div class="space-y-4">
                                    {{-- Current Image Display --}}
                                    @if($product->main_image_path)
                                        <div class="mb-4">
                                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                                <div class="flex items-center space-x-2">
                                                    <i data-lucide="image" class="w-4 h-4 text-blue-500"></i>
                                                    <span>Gambar Saat Ini</span>
                                                </div>
                                            </label>
                                            <div class="w-32 h-32 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-600">
                                                <img src="{{ Storage::url($product->main_image_path) }}" 
                                                     alt="{{ $product->name }}" 
                                                     class="w-full h-full object-cover">
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Main Image --}}
                                    <div>
                                        <label for="main_image" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="image" class="w-4 h-4 text-blue-500"></i>
                                                <span>Ganti Gambar Utama (Opsional)</span>
                                            </div>
                                        </label>
                                        <input type="file" id="main_image" name="main_image" accept="image/*"
                                            class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                        @error('main_image')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    {{-- Additional Images --}}
                                    <div>
                                        <label for="additional_images" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="images" class="w-4 h-4 text-blue-500"></i>
                                                <span>Gambar Tambahan (Opsional)</span>
                                            </div>
                                        </label>
                                        <input type="file" id="additional_images" name="additional_images[]" accept="image/*" multiple
                                            class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                        @error('additional_images')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex items-center justify-between pt-6 border-t border-slate-200 dark:border-slate-700">
                                <a href="{{ route('products.index') }}"
                                   class="group flex items-center px-6 py-3 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white font-medium rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-all duration-200">
                                    <i data-lucide="arrow-left" class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform"></i>
                                    Kembali ke Daftar
                                </a>
                                <button type="submit"
                                        class="group flex items-center px-8 py-3 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                    <i data-lucide="save" class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform"></i>
                                    Perbarui Produk
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize Lucide icons
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }

                // Animate cards on load
                const animateCards = () => {
                    const cards = document.querySelectorAll('.group.relative');
                    cards.forEach((card, index) => {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(30px)';
                        card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';

                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, index * 150);
                    });
                };

                // Start animations
                setTimeout(animateCards, 200);

                // Add form validation feedback
                const inputs = document.querySelectorAll('input, textarea, select');
                inputs.forEach(input => {
                    input.addEventListener('focus', function() {
                        this.parentElement.classList.add('ring-2', 'ring-blue-500');
                    });
                    
                    input.addEventListener('blur', function() {
                        this.parentElement.classList.remove('ring-2', 'ring-blue-500');
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>