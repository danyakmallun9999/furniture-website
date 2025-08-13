{{-- resources/views/layouts/app.blade.php --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    {{-- Google Fonts - Modern Typography --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Sidebar animation */
        .sidebar-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Glass effect */
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
        }

        /* Hover animations */
        .nav-item {
            transition: all 0.2s ease-in-out;
        }

        .nav-item:hover {
            transform: translateX(8px);
        }

        /* Mobile menu backdrop */
        .mobile-backdrop {
            backdrop-filter: blur(4px);
            background: rgba(0, 0, 0, 0.3);
        }

        /* Fix untuk proporsi yang simetris */
        .main-container {
            height: 100vh;
            overflow: hidden;
        }
        
        .sidebar-container {
            min-height: 100vh;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .content-container {
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .header-height {
            height: 73px; /* Fixed header height */
            min-height: 73px;
            max-height: 73px;
        }
        
        .main-content-height {
            height: calc(100vh - 73px); /* Subtract header height */
            overflow-y: auto;
        }
    </style>
</head>

<body class="bg-slate-50 dark:bg-slate-900">

    {{-- Mobile Menu Backdrop --}}
    <div id="mobile-backdrop" class="fixed inset-0 z-40 lg:hidden mobile-backdrop hidden"></div>

    {{-- Main Container dengan height yang fixed --}}
    <div class="flex main-container">

        {{-- Sidebar dengan proporsi yang tepat --}}
        <aside id="sidebar"
            class="sidebar-transition sidebar-container fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-slate-900 shadow-xl lg:static lg:translate-x-0 -translate-x-full">

            {{-- Sidebar Header dengan height yang sama dengan navbar --}}
            <div class="flex items-center justify-between p-6 border-b border-slate-200 dark:border-slate-700 header-height">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-slate-700 dark:bg-slate-700 rounded-xl flex items-center justify-center">
                        <i data-lucide="layout-dashboard" class="w-6 h-6 text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-800 dark:text-white">Admin </h2>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Management System</p>
                    </div>
                </div>

                {{-- Mobile Close Button --}}
                <button id="close-sidebar" class="lg:hidden p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                    <i data-lucide="x" class="w-5 h-5 text-slate-600 dark:text-slate-400"></i>
                </button>
            </div>

            {{-- Navigation Menu dengan flex-1 untuk mengisi ruang tersisa --}}
            <div class="flex-1 flex flex-col">
                <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                    {{-- Dashboard --}}
                    <a href="{{ route('dashboard') }}"
                        class="nav-item flex items-center px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('dashboard') ? 'bg-slate-700 text-white shadow-lg' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }} group">
                        <i data-lucide="home"
                            class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-500 group-hover:text-slate-700 dark:group-hover:text-slate-300' }}"></i>
                        Dashboard
                    </a>

                    {{-- Categories --}}
                    <a href="{{ route('categories.index') }}"
                        class="nav-item flex items-center px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('categories.*') ? 'bg-slate-700 text-white shadow-lg' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }} group">
                        <i data-lucide="folder"
                            class="w-5 h-5 mr-3 {{ request()->routeIs('categories.*') ? 'text-white' : 'text-slate-500 group-hover:text-slate-700 dark:group-hover:text-slate-300' }}"></i>
                        Kategori Produk
                    </a>

                    {{-- Products --}}
                    <a href="{{ route('products.index') }}"
                        class="nav-item flex items-center px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('products.*') ? 'bg-slate-700 text-white shadow-lg' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }} group">
                        <i data-lucide="package"
                            class="w-5 h-5 mr-3 {{ request()->routeIs('products.*') ? 'text-white' : 'text-slate-500 group-hover:text-slate-700 dark:group-hover:text-slate-300' }}"></i>
                        Produk Mebel
                    </a>

                    {{-- Financial Reports --}}
                    <a href="{{ route('reports.financial') }}"
                        class="nav-item flex items-center px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('reports.financial') ? 'bg-slate-700 text-white shadow-lg' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }} group">
                        <i data-lucide="bar-chart-3"
                            class="w-5 h-5 mr-3 {{ request()->routeIs('reports.financial') ? 'text-white' : 'text-slate-500 group-hover:text-slate-700 dark:group-hover:text-slate-300' }}"></i>
                        Laporan Keuangan
                    </a>

                    {{-- Invoices --}}
                    <a href="{{ route('invoices.index') }}"
                        class="nav-item flex items-center px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('invoices.*') ? 'bg-slate-700 text-white shadow-lg' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }} group">
                        <i data-lucide="file-text"
                            class="w-5 h-5 mr-3 {{ request()->routeIs('invoices.*') ? 'text-white' : 'text-slate-500 group-hover:text-slate-700 dark:group-hover:text-slate-300' }}"></i>
                        Manajemen Transaksi
                    </a>

                    {{-- Divider --}}
                    <div class="border-t border-slate-200 dark:border-slate-700 my-4"></div>

                    {{-- Settings --}}
                    <a href="{{ route('profile.edit') }}"
                        class="nav-item flex items-center px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('profile.*') ? 'bg-slate-700 text-white shadow-lg' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800' }} group">
                        <i data-lucide="settings"
                            class="w-5 h-5 mr-3 {{ request()->routeIs('profile.*') ? 'text-white' : 'text-slate-500 group-hover:text-slate-700 dark:group-hover:text-slate-300' }}"></i>
                        Pengaturan Akun
                    </a>
                </nav>

                {{-- User Profile Section - diletakkan di bottom --}}
                <div class="p-4 border-t border-slate-200 dark:border-slate-700 mt-auto">
                    <div class="flex items-center space-x-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-800">
                        <div class="w-8 h-8 bg-slate-700 dark:bg-slate-700 rounded-full flex items-center justify-center">
                            <i data-lucide="user" class="w-4 h-4 text-white"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-slate-900 dark:text-white truncate">
                                {{ Auth::user()->name ?? 'Admin User' }}
                            </p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 truncate">
                                {{ Auth::user()->email ?? 'admin@example.com' }}
                            </p>
                        </div>
                        {{-- Logout Button --}}
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="p-1.5 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
                                <i data-lucide="log-out" class="w-4 h-4 text-slate-500 dark:text-slate-400"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        {{-- Main Content Area dengan proporsi yang tepat --}}
        <div class="flex-1 content-container lg:ml-0">

            {{-- Top Navigation dengan height yang fixed --}}
            <header class="bg-white dark:bg-slate-900 shadow-sm border-b border-slate-200 dark:border-slate-700 header-height">
                <div class="flex items-center justify-between px-6 h-full">
                    <div class="flex items-center space-x-4">
                        {{-- Mobile Menu Button --}}
                        <button id="mobile-menu-button"
                            class="lg:hidden p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                            <i data-lucide="menu" class="w-5 h-5 text-slate-600 dark:text-slate-400"></i>
                        </button>

                        {{-- Page Title --}}
                        @if (isset($header))
                            <div>
                                {{ $header }}
                            </div>
                        @endif
                    </div>

                    {{-- Top Right Actions --}}
                    <div class="flex items-center space-x-4">
                        {{-- Empty space for future additions --}}
                    </div>
                </div>
            </header>

            {{-- Main Content dengan height yang calculated --}}
            <main class="main-content-height bg-slate-50 dark:bg-slate-800 p-6">
                <div class="max-w-7xl mx-auto h-full">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    {{-- Initialize Lucide Icons --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Lucide icons
            lucide.createIcons();

            // Mobile menu functionality
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const sidebar = document.getElementById('sidebar');
            const mobileBackdrop = document.getElementById('mobile-backdrop');
            const closeSidebar = document.getElementById('close-sidebar');

            function openMobileMenu() {
                sidebar.classList.remove('-translate-x-full');
                mobileBackdrop.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeMobileMenu() {
                sidebar.classList.add('-translate-x-full');
                mobileBackdrop.classList.add('hidden');
                document.body.style.overflow = '';
            }

            mobileMenuButton?.addEventListener('click', openMobileMenu);
            closeSidebar?.addEventListener('click', closeMobileMenu);
            mobileBackdrop?.addEventListener('click', closeMobileMenu);

            // Close mobile menu on escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !sidebar.classList.contains('-translate-x-full')) {
                    closeMobileMenu();
                }
            });

            // Close mobile menu on window resize
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) {
                    closeMobileMenu();
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>