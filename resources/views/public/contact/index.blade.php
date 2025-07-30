{{-- resources/views/public/contact/index.blade.php --}}

<x-guest-layout>
    {{-- Hero Section --}}
    <section class="relative min-h-[40vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0"
                style="background-image: radial-gradient(circle at 25px 25px, #10b981 2px, transparent 0), radial-gradient(circle at 75px 75px, #059669 2px, transparent 0); background-size: 100px 100px;">
            </div>
        </div>
        <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center animate-fade-in">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                Hubungi Kami
            </h1>
            <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto leading-relaxed">
                Ada pertanyaan tentang produk kami, ingin mendiskusikan desain kustom, atau memerlukan penawaran harga?
                Jangan ragu untuk menghubungi kami. Tim kami siap membantu Anda.
            </p>
        </div>
    </section>

    {{-- Kontak & Maps Section --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
                <div class="space-y-8 animate-slide-up">
                    <div class="bg-emerald-50 rounded-2xl p-8 shadow-sm flex flex-col gap-6">
                        <div class="flex items-center gap-4 mb-2">
                            <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <h3 class="font-semibold text-lg text-gray-900">Informasi Kontak</h3>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span class="font-bold text-gray-700">Telepon:</span>
                            <span class="text-gray-700">+62 812 3456 7890</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-9 13V5a2 2 0 012-2h2a2 2 0 012 2v16" />
                            </svg>
                            <span class="font-bold text-gray-700">Email:</span>
                            <span class="text-gray-700">info@furnituresite.com</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="font-bold text-gray-700">Alamat:</span>
                            <span class="text-gray-700">Jl. Industri Mebel No. 123, Kota Kayu, Indonesia</span>
                        </div>
                    </div>
                    <div class="bg-blue-50 rounded-2xl p-8 shadow-sm">
                        <div class="flex items-center gap-4 mb-2">
                            <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="font-semibold text-lg text-gray-900">Jam Operasional</h3>
                        </div>
                        <p class="text-gray-700">
                            Senin - Jumat: 09:00 - 17:00 WIB<br>
                            Sabtu: 09:00 - 14:00 WIB<br>
                            Minggu: Tutup
                        </p>
                    </div>
                    <div class="bg-purple-50 rounded-2xl p-8 shadow-sm">
                        <div class="flex items-center gap-4 mb-2">
                            <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 8a6 6 0 11-12 0 6 6 0 0112 0zM12 14v7m0 0h-3m3 0h3" />
                            </svg>
                            <h3 class="font-semibold text-lg text-gray-900">Ikuti Kami</h3>
                        </div>
                        <div class="flex space-x-4 mt-2">
                            <a href="#" class="text-gray-600 hover:text-indigo-600">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33V22H12c5.523 0 10-4.477 10-10z" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-600 hover:text-indigo-600">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.77 1.69 4.919 4.92.058 1.265.07 1.645.07 4.85s-.012 3.584-.07 4.85c-.149 3.231-1.667 4.77-4.919 4.919-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-3.251-.149-4.77-1.667-4.919-4.919-.058-1.265-.07-1.646-.07-4.85s.012-3.584.07-4.85c.149-3.23 1.667-4.77 4.919-4.919 1.266-.057 1.646-.07 4.85-.07zm0-2.163C8.756 0 8.356.014 7.09.072c-3.57.16-5.286 1.83-5.446 5.446-.057 1.266-.071 1.666-.071 4.85s.014 3.584.072 4.85c.16 3.57 1.83 5.286 5.446 5.446 1.266.057 1.666.071 4.85.071s3.584-.014 4.85-.072c3.57-.16 5.286-1.83 5.446-5.446.057-1.266.071-1.666.071-4.85s-.014-3.584-.072-4.85c-.16-3.57-1.83-5.286-5.446-5.446C15.244 0 14.844.014 12 0zm0 4.881a7.119 7.119 0 100 14.238 7.119 7.119 0 000-14.238zm0 2.062a5.057 5.057 0 110 10.114 5.057 5.057 0 010-10.114zm7.228-3.284a1.21 1.21 0 110 2.42 1.21 1.21 0 010-2.42z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="animate-fade-in">
                    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                        <h3 class="font-semibold text-lg text-gray-900 mb-2 flex items-center gap-2">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg> Lokasi Kami
                        </h3>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.195123908871!2d106.8286283147699!3d-6.208763595503004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3d9d5d5d5d5%3A0x123456789abcdef!2sYour%20Furniture%20Company%20Location!5e0!3m2!1sen!2sid!4v1678901234567!5m2!1sen!2sid"
                            width="100%" height="350" style="border:0; border-radius:1rem;" allowfullscreen=""
                            loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-20 bg-gradient-to-r from-emerald-600 to-teal-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">
                Siap Membantu Anda!
            </h2>
            <p class="text-xl text-emerald-100 mb-8 max-w-2xl mx-auto">
                Hubungi kami untuk konsultasi, pemesanan, atau pertanyaan seputar produk dan layanan kami.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="tel:+6281234567890"
                    class="inline-flex items-center justify-center px-8 py-4 bg-white text-emerald-600 font-semibold rounded-xl hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <span>Telepon Kami</span>
                </a>
                <a href="mailto:info@furnituresite.com"
                    class="inline-flex items-center justify-center px-8 py-4 bg-transparent text-white font-semibold rounded-xl border-2 border-white hover:bg-white hover:text-emerald-600 transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-9 13V5a2 2 0 012-2h2a2 2 0 012 2v16" />
                    </svg>
                    <span>Email Kami</span>
                </a>
            </div>
        </div>
    </section>
</x-guest-layout>
