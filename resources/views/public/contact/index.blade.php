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
                        @php
                            $whatsappNumber = \App\Helpers\WhatsAppHelper::getFormattedNumber();
                            $isWhatsAppConfigured = \App\Helpers\WhatsAppHelper::isConfigured();
                        @endphp
                        <div class="flex items-center gap-3">
                            <span class="font-bold text-gray-700">Telepon:</span>
                            <span class="text-gray-700">{{ $isWhatsAppConfigured ? $whatsappNumber : '+62 812 3456 7890' }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="font-bold text-gray-700">Email:</span>
                            <span class="text-gray-700">ajiningfurniture@gmail.com</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="font-bold text-gray-700">Alamat:</span>
                            <span class="text-gray-700">Jl. Kudus - Jepara, Tahunan, Jepara</span>
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
                @if($isWhatsAppConfigured)
                    <a href="{{ \App\Helpers\WhatsAppHelper::generateGeneralUrl() }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center justify-center px-8 py-4 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition-all duration-300 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                        </svg>
                        <span>WhatsApp Kami</span>
                    </a>
                @endif
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