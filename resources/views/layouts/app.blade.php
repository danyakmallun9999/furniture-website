{{-- resources/views/layouts/app.blade.php --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation') {{-- Navigasi atas dari Breeze --}}

        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <div class="flex"> {{-- Ini div baru untuk layout flex (sidebar + konten) --}}

            {{-- Sidebar --}}
            <div class="w-64 bg-gray-800 dark:bg-gray-900 text-white p-4 min-h-screen">
                <div class="text-xl font-semibold mb-6">Admin Panel</div>
                <nav>
                    <ul>
                        <li class="mb-2">
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                        </li>
                        <li class="mb-2">
                            <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')"> {{-- Nanti kita buat route ini --}}
                                {{ __('Produk') }}
                            </x-nav-link>
                        </li>
                        <li class="mb-2">
                            <x-nav-link :href="route('transactions.index')" :active="request()->routeIs('transactions.*')"> {{-- Nanti kita buat route ini --}}
                                {{ __('Transaksi') }}
                            </x-nav-link>
                        </li>
                        <li class="mb-2">
                            <x-nav-link :href="route('reports.financial')" :active="request()->routeIs('reports.financial')"> {{-- Nanti kita buat route ini --}}
                                {{ __('Laporan Keuangan') }}
                            </x-nav-link>
                        </li>
                        {{-- Tambahkan menu lain di sini --}}
                    </ul>
                </nav>
            </div>

            {{-- Main Content Area --}}
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>

        </div> {{-- Akhir div flex --}}
    </div>
    @stack('scripts')
</body>

</html>
