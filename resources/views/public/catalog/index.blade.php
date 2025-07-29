{{-- resources/views/public/catalog/index.blade.php --}}

<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold text-center text-gray-900 dark:text-gray-100 mb-8">E-Catalog Mebel Kayu
            </h1>

            {{-- Filter and Search --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-8">
                <form action="{{ route('catalog.index') }}" method="GET"
                    class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <div class="md:col-span-2">
                        <x-input-label for="search" :value="__('Cari Produk')" />
                        <x-text-input id="search" class="block mt-1 w-full" type="text" name="search"
                            :value="$search" placeholder="Cari berdasarkan nama, deskripsi, atau jenis kayu..." />
                    </div>
                    <div>
                        <x-input-label for="category" :value="__('Kategori')" />
                        <select id="category" name="category"
                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center space-x-2">
                        <x-primary-button type="submit">Filter</x-primary-button>
                        <a href="{{ route('catalog.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:bg-gray-300 dark:focus:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Reset</a>
                    </div>
                </form>
            </div>

            {{-- Product Grid --}}
            @if ($products->isEmpty())
                <p class="text-center text-gray-600 dark:text-gray-400">Tidak ada produk yang ditemukan sesuai kriteria
                    Anda.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach ($products as $product)
                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                            <a href="{{ route('catalog.show', $product->id) }}">
                                @if ($product->main_image_path)
                                    <img src="{{ Storage::url($product->main_image_path) }}" alt="{{ $product->name }}"
                                        class="w-full h-56 object-cover">
                                @else
                                    <div
                                        class="w-full h-56 bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500">
                                        No Image</div>
                                @endif
                                <div class="p-4">
                                    <h3
                                        class="font-semibold text-xl text-gray-900 dark:text-gray-100 mb-1 line-clamp-1">
                                        {{ $product->name }}</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                        {{ $product->category->name ?? 'Uncategorized' }}</p>
                                    <p class="text-sm text-gray-700 dark:text-gray-300 line-clamp-3">
                                        {{ $product->description ?? '-' }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $products->appends(request()->except('page'))->links() }}
                </div>
            @endif
        </div>
    </div>
</x-guest-layout>
