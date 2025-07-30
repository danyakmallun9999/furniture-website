{{-- resources/views/public/catalog/index.blade.php --}}

<x-guest-layout>
    {{-- Hero/Header Section --}}
    <section class="relative pt-20 overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0"
                style="background-image: radial-gradient(circle at 25px 25px, #10b981 2px, transparent 0), radial-gradient(circle at 75px 75px, #059669 2px, transparent 0); background-size: 100px 100px;">
            </div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-4">E-Catalog Mebel
                    Kayu</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Temukan koleksi mebel kayu terbaik untuk rumah dan
                    kantor Anda.</p>
            </div>
            {{-- Filter and Search --}}
            <div class="bg-white rounded-2xl border p-8 mb-12 max-w-4xl mx-auto">
                <form action="{{ route('catalog.index') }}" method="GET"
                    class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                    <div class="md:col-span-2">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Produk</label>
                        <input id="search" name="search" type="text" value="{{ $search }}"
                            placeholder="Cari berdasarkan nama, deskripsi, atau jenis kayu..."
                            class="block mt-1 w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm py-3 px-4 text-gray-900 text-base" />
                    </div>
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select id="category" name="category"
                            class="block mt-1 w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm py-3 px-4 text-gray-900 text-base">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-gray-900 text-white font-semibold rounded-xl hover:bg-gray-800 transition-all duration-300 transform hover:scale-105 shadow-lg">Filter</button>
                        <a href="{{ route('catalog.index') }}"
                            class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-xl font-semibold text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 transition-all duration-150">Reset</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- Product Grid Section --}}
    <section class="pt-10 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($products->isEmpty())
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak ada produk ditemukan</h3>
                    <p class="text-gray-600">Coba gunakan kata kunci atau filter lain.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($products as $product)
                        <div
                            class="bg-white rounded-2xl border overflow-hidden group hover:shadow-sm transition-all duration-300">
                            <a href="{{ route('catalog.show', $product->id) }}" class="block">
                                <div class="aspect-w-4 aspect-h-3 bg-gray-100 overflow-hidden">
                                    @if ($product->main_image_path)
                                        <img src="{{ Storage::url($product->main_image_path) }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div
                                            class="w-full h-64 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-2">
                                        <span
                                            class="text-sm font-medium text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">
                                            {{ $product->category->name ?? 'Furniture' }}
                                        </span>
                                    </div>
                                    <h3
                                        class="text-xl font-bold text-gray-900 mb-2 group-hover:text-emerald-600 transition-colors duration-200">
                                        {{ $product->name }}
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                        {{ $product->description ?? 'Beautiful furniture piece crafted with attention to detail and quality materials.' }}
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-lg font-bold text-gray-900">Rp
                                            {{ number_format($product->price, 0, ',', '.') }}
                                        </span>
                                        <span class="text-xs text-gray-500 mt-1 block">klik untuk lihat detail</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-12">
                    {{ $products->appends(request()->except('page'))->links() }}
                </div>
            @endif
        </div>
    </section>
</x-guest-layout>
