{{-- resources/views/public/homepage.blade.php --}}

<x-guest-layout>
    {{-- Hero Section --}}
    <div class="relative bg-gradient-to-r from-gray-700 to-gray-900 text-white py-20 md:py-32 overflow-hidden">
        <img src="{{ asset('img/hero-furniture.jpg') }}" alt="Furniture Showroom"
            class="absolute inset-0 w-full h-full object-cover opacity-50">
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-4">
                Karya Mebel Kayu Terbaik <br class="hidden md:inline"> Untuk Rumah Impian Anda
            </h1>
            <p class="text-lg md:text-xl mb-8">
                Sentuhan Keindahan Alami dan Desain Ergonomis dalam Setiap Potongan.
            </p>
            <a href="{{ route('catalog.index') }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-3 px-8 rounded-full text-lg shadow-lg transition duration-300">
                Lihat Koleksi Kami
            </a>
        </div>
    </div>
    {{-- NOTE: Anda perlu menempatkan gambar 'hero-furniture.jpg' di storage/app/public/products/ atau di public/img/ dan sesuaikan path-nya. --}}
    {{-- Anda bisa download gambar dummy dari unsplash/pexels untuk testing --}}


    {{-- Latest Products Section --}}
    <div class="py-12 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-gray-100 mb-8">Produk Terbaru Kami</h2>
            @if ($latestProducts->isEmpty())
                <p class="text-center text-gray-600 dark:text-gray-400">Belum ada produk terbaru yang ditambahkan.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($latestProducts as $product)
                        <div
                            class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                            <a href="{{ route('catalog.show', $product->id) }}">
                                @if ($product->main_image_path)
                                    <img src="{{ Storage::url($product->main_image_path) }}" alt="{{ $product->name }}"
                                        class="w-full h-48 object-cover">
                                @else
                                    <div
                                        class="w-full h-48 bg-gray-200 dark:bg-gray-600 flex items-center justify-center text-gray-500">
                                        No Image</div>
                                @endif
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100 mb-1">
                                        {{ $product->name }}</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $product->category->name ?? 'Uncategorized' }}</p>
                                    <p class="text-sm text-gray-700 dark:text-gray-300 mt-2 line-clamp-2">
                                        {{ $product->description ?? '-' }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-8">
                    <a href="{{ route('catalog.index') }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-full inline-block transition duration-300">
                        Lihat Semua Koleksi
                    </a>
                </div>
            @endif
        </div>
    </div>

    {{-- About/Philosophy Section (Contoh) --}}
    <div class="bg-gray-200 dark:bg-gray-700 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">Filosofi Kami</h2>
            <p class="text-lg text-gray-700 dark:text-gray-300 max-w-3xl mx-auto">
                Kami percaya bahwa setiap perabot harus menjadi cerminan dari alam dan keahlian tangan manusia.
                Kami memilih kayu terbaik dan memadukannya dengan desain inovatif untuk menciptakan karya yang abadi.
            </p>
            <div class="mt-8">
                <a href="{{ route('about.index') }}"
                    class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200 font-semibold">Pelajari
                    Lebih Lanjut &rarr;</a>
            </div>
        </div>
    </div>

</x-guest-layout>
