{{-- resources/views/public/catalog/show.blade.php --}}

<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 md:p-10">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Product Image --}}
                    <div>
                        @if ($product->main_image_path)
                            <img src="{{ Storage::url($product->main_image_path) }}" alt="{{ $product->name }}"
                                class="w-full h-auto object-cover rounded-lg shadow-lg">
                        @else
                            <div
                                class="w-full h-64 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center text-gray-500 text-lg">
                                Gambar Tidak Tersedia</div>
                        @endif
                    </div>

                    {{-- Product Details --}}
                    <div>
                        <h1 class="text-4xl font-extrabold text-gray-900 dark:text-gray-100 mb-4">{{ $product->name }}
                        </h1>
                        <p class="text-lg text-indigo-600 dark:text-indigo-400 mb-4">Kategori:
                            {{ $product->category->name ?? 'Tidak Berkategori' }}</p>

                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                            {{ $product->description ?? 'Deskripsi produk ini belum tersedia.' }}
                        </p>

                        <div class="grid grid-cols-2 gap-4 text-gray-700 dark:text-gray-300 mb-6">
                            <div>
                                <span class="font-semibold">Jenis Kayu:</span> {{ $product->wood_type ?? '-' }}
                            </div>
                            <div>
                                <span class="font-semibold">Dimensi:</span> {{ $product->dimensions ?? '-' }}
                            </div>
                            <div class="col-span-2">
                                <span class="font-semibold">Finishing:</span> {{ $product->finishing ?? '-' }}
                            </div>
                        </div>

                        <div class="mt-8">
                            <a href="{{ route('contact.index') }}"
                                class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-full text-lg shadow-md transition duration-300 inline-flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.445L7 10.466V13a1 1 0 001 1h4a1 1 0 001-1v-2.534l-2.133-3.021A1 1 0 0010 7z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Minta Penawaran / Konsultasi
                            </a>
                            <a href="{{ route('catalog.index') }}"
                                class="ml-4 text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200 font-semibold inline-block py-3 px-4">
                                &larr; Kembali ke Katalog
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
