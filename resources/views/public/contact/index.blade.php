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
                    <div class="bg-emerald-50 rounded-2xl p-8 flex flex-col gap-6">
                        <div class="flex items-center gap-4 mb-2">
                            <h3 class="font-semibold text-lg text-gray-900">Informasi Kontak</h3>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="font-bold text-gray-700">Telepon:</span>
                            <span class="text-gray-700">+62 812 3456 7890</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="font-bold text-gray-700">Email:</span>
                            <span class="text-gray-700">info@furnituresite.com</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="font-bold text-gray-700">Alamat:</span>
                            <span class="text-gray-700">Jl. Industri Mebel No. 123, Kota Kayu, Indonesia</span>
                        </div>
                    </div>
                    <div class="bg-blue-50 rounded-2xl p-8">
                        <div class="flex items-center gap-4 mb-2">
                            <h3 class="font-semibold text-lg text-gray-900">Jam Operasional</h3>
                        </div>
                        <p class="text-gray-700">
                            Senin - Jumat: 09:00 - 17:00 WIB<br>
                            Sabtu: 09:00 - 14:00 WIB<br>
                            Minggu: Tutup
                        </p>
                    </div>
                    <div class="bg-purple-50 rounded-2xl p-8">
                        <div class="flex items-center gap-4 mb-2">
                            <h3 class="font-semibold text-lg text-gray-900">Ikuti Kami</h3>
                        </div>
                        <div class="flex space-x-6 mt-2">
                            <a href="#" class="text-gray-600 hover:text-blue-700 transition-colors duration-200">
                                Facebook
                            </a>
                            <a href="#" class="text-gray-600 hover:text-pink-600 transition-colors duration-200">
                                Instagram
                            </a>
                        </div>
                    </div>
                </div>
                <div class="animate-fade-in">
                    <div class="bg-white rounded-2xl p-6 mb-8">
                        <h3 class="font-semibold text-lg text-gray-900 mb-2 flex items-center gap-2">
                            Lokasi Kami
                        </h3>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d619.8910898987866!2d110.68230790419202!3d-6.625214199999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sid!2sid!4v1753887960364!5m2!1sid!2sid"
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
                    class="inline-flex items-center justify-center px-8 py-4 bg-white text-emerald-600 font-semibold rounded-xl hover:bg-gray-50 transition-all duration-300 transform hover:scale-105">
                    <span>Telepon Kami</span>
                </a>
                <a href="mailto:info@furnituresite.com"
                    class="inline-flex items-center justify-center px-8 py-4 bg-transparent text-white font-semibold rounded-xl border-2 border-white hover:bg-white hover:text-emerald-600 transition-all duration-300">
                    <span>Email Kami</span>
                </a>
            </div>
        </div>
    </section>
</x-guest-layout>