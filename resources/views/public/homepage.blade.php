{{-- resources/views/public/homepage.blade.php --}}

<x-guest-layout>
    {{-- Hero Section - Modern Design --}}
    <section
        class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-emerald-50 via-white to-teal-50 pt-24 sm:pt-0">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0"
                style="background-image: radial-gradient(circle at 25px 25px, #10b981 2px, transparent 0), radial-gradient(circle at 75px 75px, #059669 2px, transparent 0); background-size: 100px 100px;">
            </div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                {{-- Left Content --}}
                <div class="text-left animate-fade-in">
                    <div
                        class="inline-flex items-center px-4 py-2 bg-emerald-100 text-emerald-800 text-sm font-medium rounded-full mb-6">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        Kualitas Mebel Premium
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-">
                        Kami bantu Anda wujudkan
                        <span class="gradient-text block">Desain Interior Modern</span>
                    </h1>

                    <p class="text-lg text-gray-600 mb-8 max-w-lg leading-relaxed">
                        Donec rutrum congue leo eget malesuada. Vestibulum ac diam sit amet quam vehicula elementum sed
                        sit amet dui. Cras ultricies ligula sed magna dictum porta.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('catalog.index') }}"
                            class="inline-flex items-center justify-center px-8 py-4 bg-gray-900 text-white font-semibold rounded-xl hover:bg-gray-800 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <span>Lihat Katalog</span>
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Right Content - Product Showcase --}}
                <div class="relative animate-slide-up">
                    <div class="grid grid-cols-2 gap-4">
                        {{-- Featured Product Cards --}}
                        <div class="space-y-4">
                            <div
                                class="bg-orange-100 rounded-2xl p-6 transform rotate-3 hover:rotate-0 transition-transform duration-300">
                                <div class="w-full h-32 bg-orange-200 rounded-xl mb-4 overflow-hidden">
                                    <img src="{{ asset('img/sofa.jpg') }}" alt="Sofa Modern"
                                         class="w-full h-full object-cover">
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-1">Sofa Modern</h3>
                                <p class="text-sm text-gray-600">Tempat duduk nyaman</p>
                            </div>

                            <div
                                class="bg-blue-100 rounded-2xl p-6 transform -rotate-2 hover:rotate-0 transition-transform duration-300">
                                <div class="w-full h-32 bg-blue-200 rounded-xl mb-4 overflow-hidden">
                                    <img src="{{ asset('img/meja-makan.jpg') }}" alt="Meja Makan"
                                         class="w-full h-full object-cover">
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-1">Meja Makan</h3>
                                <p class="text-sm text-gray-600">Sempurna untuk keluarga</p>
                            </div>
                        </div>

                        <div class="space-y-4 pt-8">
                            <div
                                class="bg-green-100 rounded-2xl p-6 transform rotate-1 hover:rotate-0 transition-transform duration-300">
                                <div class="w-full h-32 bg-green-200 rounded-xl mb-4 overflow-hidden">
                                    <img src="{{ asset('img/kursi.jpg') }}" alt="Kursi Kantor"
                                         class="w-full h-full object-cover">
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-1">Kursi Kantor</h3>
                                <p class="text-sm text-gray-600">Desain ergonomis</p>
                            </div>

                            <div
                                class="bg-purple-100 rounded-2xl p-6 transform -rotate-1 hover:rotate-0 transition-transform duration-300">
                                <div class="w-full h-32 bg-purple-200 rounded-xl mb-4 overflow-hidden">
                                    <img src="{{ asset('img/kabinet.jpg') }}" alt="Kabinet"
                                         class="w-full h-full object-cover">
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-1">Kabinet</h3>
                                <p class="text-sm text-gray-600">Solusi penyimpanan</p>
                            </div>
                        </div>
                    </div>

                    {{-- Floating Elements --}}
                    <div class="absolute -top-4 -left-4 w-20 h-20 bg-yellow-200 rounded-full opacity-60 animate-float">
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-16 h-16 bg-pink-200 rounded-full opacity-60 animate-float"
                        style="animation-delay: -2s;"></div>
                </div>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </section>

    {{-- Keunggulan Section --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Keahlian & Kualitas</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Setiap potong mebel yang kami hasilkan adalah bukti dari dedikasi dan keahlian tim pengrajin kami.
                    Kami sangat memperhatikan detail, mulai dari pemilihan kayu terbaik, proses pengeringan yang tepat,
                    hingga finishing yang sempurna.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center group">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4-8-4m16 0v10l-8 4-8-4V7" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Bahan Kayu Pilihan</h3>
                    <p class="text-gray-600">Menggunakan kayu berkualitas dari sumber berkelanjutan.</p>
                </div>
                <div class="text-center group">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Desain Inovatif</h3>
                    <p class="text-gray-600">Menggabungkan tradisi dan inovasi dalam setiap produk.</p>
                </div>
                <div class="text-center group">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Pengrajin Berpengalaman</h3>
                    <p class="text-gray-600">Dibuat oleh tangan-tangan ahli dengan dedikasi tinggi.</p>
                </div>
                <div class="text-center group">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Finishing Sempurna</h3>
                    <p class="text-gray-600">Setiap detail diperhatikan untuk hasil terbaik.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Latest Products Section - Enhanced --}}
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Dibuat dengan bahan terbaik.</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Donec rutrum congue leo eget malesuada. Vestibulum ac diam sit amet quam vehicula elementum sed sit
                    amet dui.
                </p>
            </div>

            @if ($latestProducts->isEmpty())
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Produk</h3>
                    <p class="text-gray-600">Belum ada produk terbaru yang ditambahkan.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($latestProducts as $product)
                        <div class="bg-white rounded-2xl shadow-sm overflow-hidden product-card-hover group">
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
                                        {{ $product->description ?? 'Potongan furnitur indah yang dibuat dengan perhatian terhadap detail dan bahan berkualitas.' }}
                                    </p>

                                    <div class="flex items-center justify-between">
                                        <span class="text-lg font-bold text-gray-900">Rp
                                            {{ number_format($product->price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('catalog.index') }}"
                        class="inline-flex items-center px-8 py-4 bg-gray-900 text-white font-semibold rounded-xl hover:bg-gray-800 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <span>Jelajahi</span>
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- Testimonials Section --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Testimoni</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Apa kata pelanggan kami tentang produk dan layanan kami.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Testimonial 1 --}}
                <div class="bg-gray-50 rounded-2xl p-8 relative">
                    <div class="flex items-center mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="text-gray-700 mb-6 italic">
                        "Donec rutrum congue leo eget malesuada. Vestibulum rutrum quam vitae fringilla ultricies.
                        Mauris auctor elit at imperdiet imperdiet, lorem ipsum consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore."
                    </p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-300 rounded-full mr-4"></div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Michelle Anna</h4>
                            <p class="text-sm text-gray-600">CEO, Company Inc</p>
                        </div>
                    </div>
                    <div class="absolute top-6 right-6">
                        <svg class="w-8 h-8 text-gray-300" fill="currentColor" viewBox="0 0 32 32">
                            <path
                                d="M4 16c0 6.6 5.4 12 12 12 1.2 0 2-.8 2-2s-.8-2-2-2c-4.4 0-8-3.6-8-8s3.6-8 8-8c1.2 0 2-.8 2-2s-.8-2-2-2c-6.6 0-12 5.4-12 12z" />
                            <path
                                d="m18 16c0 6.6 5.4 12 12 12 1.2 0 2-.8 2-2s-.8-2-2-2c-4.4 0-8-3.6-8-8s3.6-8 8-8c1.2 0 2-.8 2-2s-.8-2-2-2c-6.6 0-12 5.4-12 12z" />
                        </svg>
                    </div>
                </div>

                {{-- Testimonial 2 --}}
                <div class="bg-emerald-50 rounded-2xl p-8 relative">
                    <div class="flex items-center mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="text-gray-700 mb-6 italic">
                        "Vestibulum rutrum quam vitae fringilla ultricies. Mauris auctor elit at imperdiet imperdiet.
                        Donec rutrum congue leo eget malesuada. Vestibulum ac diam sit amet quam vehicula elementum."
                    </p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-300 rounded-full mr-4"></div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Robert Johnson</h4>
                            <p class="text-sm text-gray-600">Designer</p>
                        </div>
                    </div>
                    <div class="absolute top-6 right-6">
                        <svg class="w-8 h-8 text-emerald-200" fill="currentColor" viewBox="0 0 32 32">
                            <path
                                d="M4 16c0 6.6 5.4 12 12 12 1.2 0 2-.8 2-2s-.8-2-2-2c-4.4 0-8-3.6-8-8s3.6-8 8-8c1.2 0 2-.8 2-2s-.8-2-2-2c-6.6 0-12 5.4-12 12z" />
                            <path
                                d="m18 16c0 6.6 5.4 12 12 12 1.2 0 2-.8 2-2s-.8-2-2-2c-4.4 0-8-3.6-8-8s3.6-8 8-8c1.2 0 2-.8 2-2s-.8-2-2-2c-6.6 0-12 5.4-12 12z" />
                        </svg>
                    </div>
                </div>

                {{-- Testimonial 3 --}}
                <div class="bg-gray-50 rounded-2xl p-8 relative">
                    <div class="flex items-center mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="text-gray-700 mb-6 italic">
                        "Mauris auctor elit at imperdiet imperdiet, lorem ipsum dolor sit amet consectetur adipiscing
                        elit. Donec rutrum congue leo eget malesuada. Vestibulum rutrum quam vitae fringilla."
                    </p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-300 rounded-full mr-4"></div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Sarah Wilson</h4>
                            <p class="text-sm text-gray-600">Pemilik Rumah</p>
                        </div>
                    </div>
                    <div class="absolute top-6 right-6">
                        <svg class="w-8 h-8 text-gray-300" fill="currentColor" viewBox="0 0 32 32">
                            <path
                                d="M4 16c0 6.6 5.4 12 12 12 1.2 0 2-.8 2-2s-.8-2-2-2c-4.4 0-8-3.6-8-8s3.6-8 8-8c1.2 0 2-.8 2-2s-.8-2-2-2c-6.6 0-12 5.4-12 12z" />
                            <path
                                d="m18 16c0 6.6 5.4 12 12 12 1.2 0 2-.8 2-2s-.8-2-2-2c-4.4 0-8-3.6-8-8s3.6-8 8-8c1.2 0 2-.8 2-2s-.8-2-2-2c-6.6 0-12 5.4-12 12z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- CTA Section --}}
    <section class="py-20 bg-gradient-to-r from-emerald-600 to-teal-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">
                Siap Mengubah Rumah Anda?
            </h2>
            <p class="text-xl text-emerald-100 mb-8 max-w-2xl mx-auto">
                Jelajahi koleksi furnitur premium kami yang luas dan temukan perabot yang sempurna untuk rumah impian Anda.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('catalog.index') }}"
                    class="inline-flex items-center justify-center px-8 py-4 bg-white text-emerald-600 font-semibold rounded-xl hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <span>Jelajahi Katalog</span>
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>

                <a href="{{ route('contact.index') }}"
                    class="inline-flex items-center justify-center px-8 py-4 bg-transparent text-white font-semibold rounded-xl border-2 border-white hover:bg-white hover:text-emerald-600 transition-all duration-300">
                    <span>Hubungi Kami</span>
                </a>
            </div>
        </div>
    </section>

</x-guest-layout>