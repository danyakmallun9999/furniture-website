{{-- resources/views/public/about/index.blade.php --}}

<x-guest-layout>
    {{-- Hero Section --}}
    <section
        class="relative min-h-[40vh] flex items-center justify-center overflow-hidden bg-gradient-to-br from-emerald-50 via-white to-teal-50">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0"
                style="background-image: radial-gradient(circle at 25px 25px, #10b981 2px, transparent 0), radial-gradient(circle at 75px 75px, #059669 2px, transparent 0); background-size: 100px 100px;">
            </div>
        </div>
        <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center animate-fade-in">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                Tentang Kami
            </h1>
            <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto leading-relaxed">
                Didirikan pada tahun 2000, <span class="font-semibold text-emerald-700">Ajining Furniture</span>
                telah menjadi produsen mebel kayu terkemuka di Indonesia, dikenal akan komitmen kami terhadap kualitas,
                keahlian tradisional, dan desain inovatif.
            </p>
        </div>
    </section>

    {{-- Visi & Misi Section --}}
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="animate-slide-up">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Visi Kami</h2>
                    <p class="text-gray-700 mb-6">
                        Menjadi pilihan utama bagi pelanggan yang mencari mebel kayu berkualitas tinggi, fungsional, dan
                        estetis, yang membawa kehangatan dan keindahan alami ke setiap ruangan.
                    </p>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Misi Kami</h2>
                    <ul class="list-disc list-inside text-gray-700 space-y-2">
                        <li>Menggunakan bahan baku kayu pilihan dari sumber yang berkelanjutan.</li>
                        <li>Menggabungkan keahlian pengrajin lokal dengan teknologi modern untuk hasil terbaik.</li>
                        <li>Menyediakan layanan desain kustom untuk memenuhi kebutuhan unik pelanggan.</li>
                        <li>Membangun hubungan jangka panjang dengan pelanggan melalui kualitas dan integritas.</li>
                    </ul>
                </div>
                <div class="flex justify-center animate-fade-in">
                    <div
                        class="w-80 h-80 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-3xl flex items-center justify-center shadow-lg">
                        <svg class="w-32 h-32 text-emerald-400" fill="none" stroke="currentColor"
                            viewBox="0 0 48 48">
                            <rect x="8" y="16" width="32" height="24" rx="4" fill="currentColor"
                                class="text-emerald-200" />
                            <rect x="16" y="8" width="16" height="16" rx="4" fill="currentColor"
                                class="text-emerald-300" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>



</x-guest-layout>
