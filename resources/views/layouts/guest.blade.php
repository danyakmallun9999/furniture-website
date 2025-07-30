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
        <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
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
                        &copy; {{ date('Y') }} Ajining Furniture . All rights reserved.
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
                nav.classList.add('border');
            } else {
                nav.classList.remove('shadow-lg');
            }
        });
    </script>
</body>

</html>
