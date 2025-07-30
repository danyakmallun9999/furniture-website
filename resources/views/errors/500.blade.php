{{-- resources/views/errors/500.blade.php --}}

<x-guest-layout>
    <section
        class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-emerald-50 via-white to-teal-50">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0"
                style="background-image: radial-gradient(circle at 25px 25px, #10b981 2px, transparent 0), radial-gradient(circle at 75px 75px, #059669 2px, transparent 0); background-size: 100px 100px;">
            </div>
        </div>

        <div class="relative z-10 max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center animate-fade-in">
            <p class="text-6xl sm:text-7xl lg:text-8xl font-extrabold text-gray-900 mb-4 leading-none">500</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-4">Kesalahan Server Internal</h1>
            <p class="text-lg text-gray-600 mb-8">
                Maaf, ada masalah di server kami. Kami sedang berusaha memperbaikinya. Silakan coba lagi nanti.
            </p>
            <a href="{{ url('/') }}"
                class="inline-flex items-center justify-center px-8 py-4 bg-gray-900 text-white font-semibold rounded-xl hover:bg-gray-800 transition-all duration-300 transform hover:scale-105">
                <span>Kembali ke Beranda</span>
            </a>
        </div>
    </section>
</x-guest-layout>
