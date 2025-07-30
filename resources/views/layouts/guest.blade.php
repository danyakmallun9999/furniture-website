<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Furni Studio') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-inter {
            font-family: 'Inter', sans-serif;
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }

        .animate-slide-up {
            animation: slideUp 0.8s ease-out forwards;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .gradient-text {
            background: linear-gradient(135deg, #059669, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-morphism {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .product-card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .product-card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
    </style>
</head>

<body class="font-inter antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen flex flex-col">

        {{-- Modern Navigation Header --}}
        <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    {{-- Logo Section --}}
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="flex items-center space-x-2">
                            <span class="text-xl font-bold text-gray-900">Ajining Furniture</span>
                        </a>
                    </div>

                    {{-- Desktop Navigation --}}
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="{{ url('/') }}"
                            class="text-sm font-medium text-gray-900 hover:text-emerald-600 transition-colors duration-200 {{ request()->is('/') ? 'text-emerald-600' : '' }}">
                            Home
                        </a>
                        <a href="{{ route('catalog.index') }}"
                            class="text-sm font-medium text-gray-700 hover:text-emerald-600 transition-colors duration-200 {{ request()->routeIs('catalog.*') ? 'text-emerald-600' : '' }}">
                            E-Catalog
                        </a>
                        <a href="{{ route('about.index') }}"
                            class="text-sm font-medium text-gray-700 hover:text-emerald-600 transition-colors duration-200 {{ request()->routeIs('about.*') ? 'text-emerald-600' : '' }}">
                            About us
                        </a>
                        <a href="{{ route('contact.index') }}"
                            class="text-sm font-medium text-gray-700 hover:text-emerald-600 transition-colors duration-200 {{ request()->routeIs('contact.*') ? 'text-emerald-600' : '' }}">
                            Contact us
                        </a>
                    </div>


                    {{-- Mobile Menu Button --}}
                    <div class="md:hidden">
                        <button type="button"
                            class="mobile-menu-button p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-colors duration-200"
                            onclick="toggleMobileMenu()">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path class="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path class="close-icon hidden" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Mobile Menu --}}
            <div class="mobile-menu hidden md:hidden bg-white border-t border-gray-100">
                <div class="px-4 py-6 space-y-4">
                    <a href="{{ url('/') }}"
                        class="block text-base font-medium text-gray-900 hover:text-emerald-600 transition-colors duration-200">Home</a>
                    <a href="{{ route('catalog.index') }}"
                        class="block text-base font-medium text-gray-700 hover:text-emerald-600 transition-colors duration-200">Services</a>
                    <a href="{{ route('about.index') }}"
                        class="block text-base font-medium text-gray-700 hover:text-emerald-600 transition-colors duration-200">About
                        us</a>
                    <a href="{{ route('contact.index') }}"
                        class="block text-base font-medium text-gray-700 hover:text-emerald-600 transition-colors duration-200">Contact
                        us</a>
                </div>
            </div>
        </nav>

        {{-- Main Content Slot with top padding for fixed nav --}}
        <main class="flex-grow pt-16">
            {{ $slot }}
        </main>

        {{-- Modern Footer --}}
        <footer class="bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    {{-- Company Info --}}
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center space-x-2 mb-4">
                            <span class="text-xl font-bold">Ajining Furniture</span>
                        </div>
                        <p class="text-gray-400 text-sm mb-4 max-w-md">
                            Menciptakan furnitur berkualitas tinggi dengan desain modern untuk rumah impian Anda.
                            Setiap produk dibuat dengan keahlian tangan dan perhatian detail.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.404-5.965 1.404-5.965s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.098.119.112.224.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z.017-.001z" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Quick Links --}}
                    <div>
                        <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Quick Links</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ url('/') }}"
                                    class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Home</a>
                            </li>
                            <li><a href="{{ route('catalog.index') }}"
                                    class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Catalog</a>
                            </li>
                            <li><a href="{{ route('about.index') }}"
                                    class="text-gray-400 hover:text-white text-sm transition-colors duration-200">About
                                    Us</a></li>
                            <li><a href="{{ route('contact.index') }}"
                                    class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Contact</a>
                            </li>
                        </ul>
                    </div>

                    {{-- Contact Info --}}
                    <div>
                        <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Contact Info</h3>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li>Jl. Furniture Street No. 123</li>
                            <li>Jakarta, Indonesia</li>
                            <li class="mt-2">
                                <a href="tel:+6281234567890" class="hover:text-white transition-colors duration-200">
                                    +62 812-3456-7890
                                </a>
                            </li>
                            <li>
                                <a href="mailto:info@furni.com" class="hover:text-white transition-colors duration-200">
                                    info@furni.com
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                    <p class="text-gray-400 text-sm">
                        &copy; {{ date('Y') }} {{ config('app.name', 'Furni Studio') }}. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>

    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.querySelector('.mobile-menu');
            const menuIcon = document.querySelector('.menu-icon');
            const closeIcon = document.querySelector('.close-icon');

            mobileMenu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        }

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add scroll effect to navbar
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 0) {
                nav.classList.add('shadow-lg');
            } else {
                nav.classList.remove('shadow-lg');
            }
        });
    </script>
</body>

</html>
