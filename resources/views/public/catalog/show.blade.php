{{-- resources/views/public/catalog/show.blade.php --}}

<x-guest-layout>

    {{-- Section Detail Produk --}}
    <section class="pt-6 pb-20">
        {{-- Menggunakan max-w-6xl untuk container yang lebih lebar --}}
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Tambahkan padding di sini, dan shadow/border untuk seluruh card --}}
            <div class="bg-white border rounded-2xl shadow-sm overflow-hidden animate-slide-up p-6">

                {{-- Bagian Atas: Gambar (kiri) dan Info Dasar (kanan) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start"> {{-- Menggunakan grid 2 kolom --}}

                    {{-- Kolom Kiri: Galeri Gambar Produk (Slider + Thumbnail) --}}
                    <div>
                        <div class="w-full relative bg-gray-50 p-2 rounded-lg"> {{-- Padding dan background untuk kontainer gambar --}}
                            {{-- Kontainer Utama Slider --}}
                            <div id="product-image-slider" class="relative overflow-hidden rounded-lg">
                                <div class="flex transition-transform duration-300 ease-in-out" id="slider-content">
                                    {{-- Gambar Utama --}}
                                    @if ($product->main_image_path)
                                        <div class="w-full flex-shrink-0">
                                            <img src="{{ Storage::url($product->main_image_path) }}" alt="{{ $product->name }}"
                                                class="w-full h-[400px] object-contain mx-auto" /> {{-- Tinggi tetap --}}
                                        </div>
                                    @else
                                        <div class="w-full flex-shrink-0 h-[400px] bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif

                                    {{-- Gambar Tambahan --}}
                                    @forelse ($product->images as $image)
                                        <div class="w-full flex-shrink-0">
                                            <img src="{{ Storage::url($image->image_path) }}" alt="Gambar Produk Tambahan"
                                                class="w-full h-[400px] object-contain mx-auto" />
                                        </div>
                                    @empty
                                        {{-- Jika tidak ada gambar tambahan --}}
                                    @endforelse
                                </div>

                                {{-- Navigasi Slider (Panah Kiri Kanan) --}}
                                <button id="slider-prev" class="absolute top-1/2 left-2 -translate-y-1/2 bg-gray-800 bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 focus:outline-none">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                                <button id="slider-next" class="absolute top-1/2 right-2 -translate-y-1/2 bg-gray-800 bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 focus:outline-none">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </div>

                            {{-- Thumbnail Navigasi --}}
                            @php
                                $allImages = collect();
                                if ($product->main_image_path) {
                                    $allImages->push(['path' => $product->main_image_path, 'is_main' => true]);
                                }
                                foreach ($product->images as $img) {
                                    $allImages->push(['path' => $img->image_path, 'is_main' => false]);
                                }
                            @endphp

                            @if ($allImages->count() > 1)
                                <div class="flex justify-center gap-2 mt-4 overflow-x-auto pb-2">
                                    @foreach ($allImages as $index => $img)
                                        <img src="{{ Storage::url($img['path']) }}" alt="Thumbnail"
                                            class="thumbnail-item w-20 h-20 object-cover rounded-md cursor-pointer border-2 border-transparent hover:border-emerald-500 transition-colors duration-150 {{ $index === 0 ? 'border-emerald-500' : '' }}"
                                            data-slide-to="{{ $index }}">
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Kolom Kanan: Info Dasar Produk --}}
                    <div>
                        {{-- Kategori dan Nama --}}
                        <div class="mb-4">
                            <span class="inline-block text-sm font-medium text-emerald-600 bg-emerald-50 px-4 py-1 rounded-full mb-2">
                                {{ $product->category->name ?? 'Furniture' }}
                            </span>
                            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight">
                                {{ $product->name }}
                            </h1>
                        </div>

                        {{-- Harga dan Ringkasan --}}
                        <div class="mb-6">
                            @if ($product->price)
                                <span class="text-3xl font-bold text-gray-900 bg-white/80 px-5 py-2 rounded-xl shadow inline-block">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            @else
                                <span class="text-2xl font-bold text-gray-700 bg-white/80 px-5 py-2 rounded-xl shadow inline-block">
                                    Harga Menyesuaikan
                                </span>
                            @endif
                            <p class="text-gray-600 leading-relaxed mt-4 text-base">
                                {{ $product->short_description ?? 'Deskripsi singkat produk ini belum tersedia.' }}
                            </p>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="mt-8 flex flex-col sm:flex-row gap-3 w-full"> {{-- Hapus justify-center --}}
                            <a href="{{ route('contact.index') }}"
                                class="inline-flex items-center justify-center px-6 py-2.5 bg-emerald-600 text-white font-semibold rounded-xl hover:bg-emerald-700 transition-all duration-300 shadow">

                                Minta Penawaran
                            </a>
                            <a href="{{ route('catalog.index') }}"
                                class="inline-flex items-center justify-center px-6 py-2.5 bg-gray-200 border border-transparent rounded-xl font-semibold text-gray-700 hover:bg-gray-300 transition-all duration-150">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                                Kembali ke Katalog
                            </a>
                        </div>
                    </div>
                </div> {{-- End of grid container --}}

                {{-- Bagian Bawah: Spesifikasi Produk & Deskripsi Lengkap --}}
                <div class="border-t border-gray-200 pt-6 mt-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Spesifikasi Produk</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-gray-700"> {{-- Bisa lebih dari 2 kolom untuk specs --}}
                        @if ($product->product_type)
                            <div class="flex items-center gap-2 bg-gray-50 p-3 rounded-lg">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                <span><span class="font-semibold">Jenis Produk:</span> {{ $product->product_type }}</span>
                            </div>
                        @endif
                        @if ($product->motif)
                            <div class="flex items-center gap-2 bg-gray-50 p-3 rounded-lg">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                <span><span class="font-semibold">Motif:</span> {{ $product->motif }}</span>
                            </div>
                        @endif
                        @if ($product->wood_type)
                            <div class="flex items-center gap-2 bg-gray-50 p-3 rounded-lg">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                <span><span class="font-semibold">Jenis Kayu:</span> {{ $product->wood_type }}</span>
                            </div>
                        @endif
                        @if ($product->dimensions)
                            <div class="flex items-center gap-2 bg-gray-50 p-3 rounded-lg">
                                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                </svg>
                                <span><span class="font-semibold">Dimensi:</span> {{ $product->dimensions }}</span>
                            </div>
                        @endif
                        @if ($product->finishing)
                            <div class="flex items-center gap-2 bg-gray-50 p-3 rounded-lg">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                <span><span class="font-semibold">Finishing:</span> {{ $product->finishing }}</span>
                            </div>
                        @endif
                        <div class="flex items-center gap-2 bg-gray-50 p-3 rounded-lg">
                            <svg class="w-5 h-5 {{ $product->is_customizable ? 'text-green-500' : 'text-red-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if ($product->is_customizable)
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                @endif
                            </svg>
                            <span><span class="font-semibold">Dapat Dikustomisasi:</span> {{ $product->is_customizable ? 'Ya' : 'Tidak' }}</span>
                        </div>
                    </div>
                </div>

                @if ($product->description)
                    <div class="border-t border-gray-200 pt-6 mt-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Deskripsi Lengkap</h3>
                        <p class="text-gray-700 leading-relaxed text-base">
                            {{ $product->description }}
                        </p>
                    </div>
                @endif

            </div> {{-- End of bg-white card --}}
        </div>
    </section>

    {{-- Script JavaScript untuk Slider Gambar --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sliderContent = document.getElementById('slider-content');
            const prevButton = document.getElementById('slider-prev');
            const nextButton = document.getElementById('slider-next');
            const thumbnails = document.querySelectorAll('.thumbnail-item');
            const totalSlides = sliderContent.children.length;
            let currentSlide = 0;

            function updateSlider() {
                const offset = -currentSlide * 100;
                sliderContent.style.transform = `translateX(${offset}%)`;

                thumbnails.forEach((thumb, index) => {
                    if (index === currentSlide) {
                        thumb.classList.add('border-emerald-500');
                        thumb.classList.remove('border-transparent');
                    } else {
                        thumb.classList.remove('border-emerald-500');
                        thumb.classList.add('border-transparent');
                    }
                });
            }

            prevButton.addEventListener('click', function() {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                updateSlider();
            });

            nextButton.addEventListener('click', function() {
                currentSlide = (currentSlide + 1) % totalSlides;
                updateSlider();
            });

            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    currentSlide = parseInt(this.dataset.slideTo);
                    updateSlider();
                });
            });

            updateSlider(); // Inisialisasi slider

            // Sembunyikan tombol navigasi jika hanya ada 1 gambar
            if (totalSlides <= 1) {
                prevButton.style.display = 'none';
                nextButton.style.display = 'none';
            }
        });
    </script>
</x-guest-layout>