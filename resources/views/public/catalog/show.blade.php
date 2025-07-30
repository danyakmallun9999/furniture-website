{{-- resources/views/public/catalog/show.blade.php --}}

<x-guest-layout>
    {{-- Section Header dengan background gradasi dan pattern --}}
    {{-- <section class="relative pt-20 overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0"
                style="background-image: radial-gradient(circle at 25px 25px, #10b981 2px, transparent 0), radial-gradient(circle at 75px 75px, #059669 2px, transparent 0); background-size: 100px 100px;">
            </div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="inline-block text-sm font-medium text-emerald-600 bg-emerald-50 px-4 py-1 rounded-full mb-4 animate-fade-in">
                    {{ $product->category->name ?? 'Furniture' }}
                </span>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-2 animate-fade-in">
                    {{ $product->name }}
                </h1>
            </div>
        </div>
    </section> --}}

    {{-- Card Detail Produk --}}
    <section class="pt-6 pb-20">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border rounded-2xl shadow-sm overflow-hidden animate-slide-up">
                {{-- Product Image Full Width, No Padding --}}
                <div class="w-full relative">
                    <div class="absolute -top-4 -left-4 w-20 h-20 bg-emerald-100 rounded-full blur-2xl opacity-60 z-0">
                    </div>
                    <div
                        class="absolute -bottom-4 -right-4 w-14 h-14 bg-orange-100 rounded-full blur-2xl opacity-60 z-0">
                    </div>
                    @if ($product->main_image_path)
                        <img src="{{ Storage::url($product->main_image_path) }}" alt="{{ $product->name }}"
                            class="relative z-10 w-full max-h-[400px] object-contain rounded-t-2xl bg-white" />
                    @else
                        <div
                            class="relative z-10 w-full h-64 bg-gradient-to-br from-gray-100 to-gray-200 rounded-t-2xl flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                </div>
                {{-- Info Produk (dengan padding) --}}
                <div class="w-full flex flex-col items-center text-center px-6 py-8">
                    <div class="flex justify-center items-center gap-2 mb-2 animate-fade-in">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                        <span class="text-xs text-gray-500 ml-2">(4.5)</span>
                    </div>
                    <div class="flex justify-center items-center gap-2 mb-4 animate-fade-in">
                        <span
                            class="text-xl font-bold text-gray-900 bg-white/80 px-5 py-1.5 rounded-xl shadow inline-block">Rp
                            {{ number_format(rand(500000, 2000000), 0, ',', '.') }}</span>
                    </div>
                    <p class="text-gray-700 leading-relaxed mb-6 text-base md:text-lg">
                        {{ $product->description ?? 'Deskripsi produk ini belum tersedia.' }}
                    </p>
                    <div class="grid grid-cols-1 gap-3 text-gray-700 mb-8 w-full max-w-md mx-auto">
                        <div class="flex items-center gap-2 justify-center">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6" />
                            </svg>
                            <span><span class="font-semibold">Jenis Kayu:</span> {{ $product->wood_type ?? '-' }}</span>
                        </div>
                        <div class="flex items-center gap-2 justify-center">
                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            <span><span class="font-semibold">Dimensi:</span> {{ $product->dimensions ?? '-' }}</span>
                        </div>
                        <div class="flex items-center gap-2 justify-center">
                            <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                            </svg>
                            <span><span class="font-semibold">Finishing:</span> {{ $product->finishing ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="mt-4 flex flex-col sm:flex-row gap-3 justify-center w-full">
                        <a href="{{ route('contact.index') }}"
                            class="inline-flex items-center justify-center px-6 py-2.5 bg-emerald-600 text-white font-semibold rounded-xl hover:bg-emerald-700 transition-all duration-300 shadow">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.445L7 10.466V13a1 1 0 001 1h4a1 1 0 001-1v-2.534l-2.133-3.021A1 1 0 0010 7z"
                                    clip-rule="evenodd"></path>
                            </svg>
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
            </div>
        </div>
    </section>
</x-guest-layout>
