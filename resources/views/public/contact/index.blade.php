{{-- resources/views/public/contact/index.blade.php --}}

<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-4xl font-extrabold text-gray-900 dark:text-gray-100 mb-6 text-center">Hubungi Kami</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                            Ada pertanyaan tentang produk kami, ingin mendiskusikan desain kustom, atau memerlukan
                            penawaran harga? Jangan ragu untuk menghubungi kami. Tim kami siap membantu Anda.
                        </p>
                        <div class="mb-4">
                            <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100">Informasi Kontak</h3>
                            <p class="text-gray-700 dark:text-gray-300">
                                <span class="font-bold">Telepon:</span> +62 812 3456 7890<br>
                                <span class="font-bold">Email:</span> info@furnituresite.com<br>
                                <span class="font-bold">Alamat:</span> Jl. Industri Mebel No. 123, Kota Kayu,
                                Indonesia<br>
                            </p>
                        </div>
                        <div class="mb-4">
                            <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100">Jam Operasional</h3>
                            <p class="text-gray-700 dark:text-gray-300">
                                Senin - Jumat: 09:00 - 17:00 WIB<br>
                                Sabtu: 09:00 - 14:00 WIB<br>
                                Minggu: Tutup
                            </p>
                        </div>
                        <div class="mt-6">
                            <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100">Ikuti Kami</h3>
                            <div class="flex space-x-4 mt-2">
                                <a href="#"
                                    class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">
                                    {{-- SVG Icon for Facebook --}}
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path
                                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33V22H12c5.523 0 10-4.477 10-10z" />
                                    </svg>
                                </a>
                                <a href="#"
                                    class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400">
                                    {{-- SVG Icon for Instagram --}}
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path
                                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.77 1.69 4.919 4.92.058 1.265.07 1.645.07 4.85s-.012 3.584-.07 4.85c-.149 3.231-1.667 4.77-4.919 4.919-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-3.251-.149-4.77-1.667-4.919-4.919-.058-1.265-.07-1.646-.07-4.85s.012-3.584.07-4.85c.149-3.23 1.667-4.77 4.919-4.919 1.266-.057 1.646-.07 4.85-.07zm0-2.163C8.756 0 8.356.014 7.09.072c-3.57.16-5.286 1.83-5.446 5.446-.057 1.266-.071 1.666-.071 4.85s.014 3.584.072 4.85c.16 3.57 1.83 5.286 5.446 5.446 1.266.057 1.666.071 4.85.071s3.584-.014 4.85-.072c3.57-.16 5.286-1.83 5.446-5.446.057-1.266.071-1.666.071-4.85s-.014-3.584-.072-4.85c-.16-3.57-1.83-5.286-5.446-5.446C15.244 0 14.844.014 12 0zm0 4.881a7.119 7.119 0 100 14.238 7.119 7.119 0 000-14.238zm0 2.062a5.057 5.057 0 110 10.114 5.057 5.057 0 010-10.114zm7.228-3.284a1.21 1.21 0 110 2.42 1.21 1.21 0 010-2.42z" />
                                    </svg>
                                </a>
                                {{-- Tambahkan icon media sosial lain --}}
                            </div>
                        </div>
                    </div>
                    <div>
                        {{-- Google Maps Embed (contoh) --}}
                        <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100 mb-2">Lokasi Kami</h3>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.195123908871!2d106.8286283147699!3d-6.208763595503004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3d9d5d5d5d5%3A0x123456789abcdef!2sYour%20Furniture%20Company%20Location!5e0!3m2!1sen!2sid!4v1678901234567!5m2!1sen!2sid"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        {{-- Ganti URL embed Google Maps dengan lokasi industri mebel Anda --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
