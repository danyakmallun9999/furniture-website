{{-- resources/views/admin/reports/financial.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center space-x-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white leading-tight">
                        Laporan Keuangan Detail
                    </h2>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                        Analisis mendalam keuangan bisnis Anda
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="mb-6 group relative">
                    <div class="absolute inset-0 bg-emerald-100 dark:bg-emerald-900/20 rounded-2xl opacity-75 group-hover:opacity-100 blur-sm group-hover:blur-none transition-all duration-300"></div>
                    <div class="relative bg-white dark:bg-slate-900 rounded-2xl p-4 shadow-xl border border-emerald-200 dark:border-emerald-800">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-emerald-500 rounded-xl flex items-center justify-center">
                                <i data-lucide="check-circle" class="w-4 h-4 text-white"></i>
                            </div>
                            <span class="text-emerald-700 dark:text-emerald-300 font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 group relative">
                    <div class="absolute inset-0 bg-red-100 dark:bg-red-900/20 rounded-2xl opacity-75 group-hover:opacity-100 blur-sm group-hover:blur-none transition-all duration-300"></div>
                    <div class="relative bg-white dark:bg-slate-900 rounded-2xl p-4 shadow-xl border border-red-200 dark:border-red-800">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-red-500 rounded-xl flex items-center justify-center">
                                <i data-lucide="alert-circle" class="w-4 h-4 text-white"></i>
                            </div>
                            <span class="text-red-700 dark:text-red-300 font-medium">{{ session('error') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 group relative">
                    <div class="absolute inset-0 bg-red-100 dark:bg-red-900/20 rounded-2xl opacity-75 group-hover:opacity-100 blur-sm group-hover:blur-none transition-all duration-300"></div>
                    <div class="relative bg-white dark:bg-slate-900 rounded-2xl p-4 shadow-xl border border-red-200 dark:border-red-800">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-red-500 rounded-xl flex items-center justify-center">
                                <i data-lucide="alert-circle" class="w-4 h-4 text-white"></i>
                            </div>
                            <div>
                                <span class="text-red-700 dark:text-red-300 font-medium">Terjadi kesalahan:</span>
                                <ul class="list-disc list-inside mt-1 text-sm text-red-600 dark:text-red-400">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Summary Cards --}}
            <div class="mb-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Total Pemasukan --}}
                    <div class="group relative">
                        <div class="absolute inset-0 bg-emerald-100 dark:bg-emerald-900/20 rounded-2xl opacity-75 group-hover:opacity-100 blur-sm group-hover:blur-none transition-all duration-300"></div>
                        <div class="relative bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 border border-slate-200 dark:border-slate-700">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <i data-lucide="trending-up" class="w-5 h-5 text-white"></i>
                                </div>
                                <div class="flex items-center space-x-1 text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20 px-2 py-1 rounded-full">
                                    <i data-lucide="arrow-up" class="w-3 h-3"></i>
                                    <span class="text-xs font-semibold">Pemasukan</span>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-sm font-medium text-slate-600 dark:text-slate-400 uppercase tracking-wider">
                                    Total Pemasukan
                                </h3>
                                <p class="text-3xl font-bold text-slate-900 dark:text-white">
                                    Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Total Pengeluaran --}}
                    <div class="group relative">
                        <div class="absolute inset-0 bg-red-100 dark:bg-red-900/20 rounded-2xl opacity-75 group-hover:opacity-100 blur-sm group-hover:blur-none transition-all duration-300"></div>
                        <div class="relative bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 border border-slate-200 dark:border-slate-700">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-10 h-10 bg-gradient-to-r from-red-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <i data-lucide="trending-down" class="w-5 h-5 text-white"></i>
                                </div>
                                <div class="flex items-center space-x-1 text-red-600 bg-red-50 dark:bg-red-900/20 px-2 py-1 rounded-full">
                                    <i data-lucide="arrow-down" class="w-3 h-3"></i>
                                    <span class="text-xs font-semibold">Pengeluaran</span>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-sm font-medium text-slate-600 dark:text-slate-400 uppercase tracking-wider">
                                    Total Pengeluaran
                                </h3>
                                <p class="text-3xl font-bold text-slate-900 dark:text-white">
                                    Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Laba/Rugi Bersih --}}
                    <div class="group relative">
                        <div class="absolute inset-0 bg-violet-100 dark:bg-violet-900/20 rounded-2xl opacity-75 group-hover:opacity-100 blur-sm group-hover:blur-none transition-all duration-300"></div>
                        <div class="relative bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 border border-slate-200 dark:border-slate-700">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-10 h-10 bg-gradient-to-r from-violet-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <i data-lucide="wallet" class="w-5 h-5 text-white"></i>
                                </div>
                                <div class="flex items-center space-x-1 {{ $labaRugiBersih >= 0 ? 'text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20' : 'text-red-600 bg-red-50 dark:bg-red-900/20' }} px-2 py-1 rounded-full">
                                    <i data-lucide="{{ $labaRugiBersih >= 0 ? 'arrow-up' : 'arrow-down' }}" class="w-3 h-3"></i>
                                    <span class="text-xs font-semibold">
                                        {{ $labaRugiBersih >= 0 ? 'Untung' : 'Rugi' }}
                                    </span>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-sm font-medium text-slate-600 dark:text-slate-400 uppercase tracking-wider">
                                    Laba/Rugi Bersih
                                </h3>
                                <p class="text-3xl font-bold {{ $labaRugiBersih >= 0 ? 'text-emerald-600' : 'text-red-600' }}">
                                    Rp {{ number_format($labaRugiBersih, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Content Card --}}
            <div class="group relative">
                <div class="absolute inset-0 bg-slate-100 dark:bg-slate-800 rounded-2xl opacity-75 group-hover:opacity-100 blur-sm group-hover:blur-none transition-all duration-300"></div>
                <div class="relative bg-white dark:bg-slate-900 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 border border-slate-200 dark:border-slate-700">
                    {{-- Header Section --}}
                    <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center">
                                    <i data-lucide="bar-chart-3" class="w-5 h-5 text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Laporan Keuangan</h3>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">Analisis transaksi keuangan</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('reports.financial.export', request()->all()) }}"
                                    class="group flex items-center px-4 py-2 bg-gradient-to-r from-emerald-500 to-cyan-600 hover:from-emerald-600 hover:to-cyan-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                    <i data-lucide="download" class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform"></i>
                                    Ekspor Excel
                                </a>
                                <a href="{{ route('reports.financial.import') }}"
                                    class="group flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                    <i data-lucide="upload" class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform"></i>
                                    Impor Excel
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Filter Section --}}
                    <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                        <form action="{{ route('reports.financial') }}" method="GET">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                {{-- Tipe Transaksi --}}
                                <div>
                                    <label for="type_filter" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                        <div class="flex items-center space-x-2">
                                            <i data-lucide="activity" class="w-4 h-4 text-blue-500"></i>
                                            <span>Tipe Transaksi</span>
                                        </div>
                                    </label>
                                    <select id="type_filter" name="type"
                                        class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                        <option value="">Semua Tipe</option>
                                        <option value="kredit" {{ request('type') == 'kredit' ? 'selected' : '' }}>Kredit (Pemasukan)</option>
                                        <option value="debit" {{ request('type') == 'debit' ? 'selected' : '' }}>Debit (Pengeluaran)</option>
                                    </select>
                                </div>

                                {{-- Dari Tanggal --}}
                                <div>
                                    <label for="start_date" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                        <div class="flex items-center space-x-2">
                                            <i data-lucide="calendar" class="w-4 h-4 text-blue-500"></i>
                                            <span>Dari Tanggal</span>
                                        </div>
                                    </label>
                                    <input type="date" id="start_date" name="start_date"
                                        value="{{ request('start_date') }}"
                                        class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                </div>

                                {{-- Sampai Tanggal --}}
                                <div>
                                    <label for="end_date" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                        <div class="flex items-center space-x-2">
                                            <i data-lucide="calendar" class="w-4 h-4 text-blue-500"></i>
                                            <span>Sampai Tanggal</span>
                                        </div>
                                    </label>
                                    <input type="date" id="end_date" name="end_date"
                                        value="{{ request('end_date') }}"
                                        class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                </div>

                                {{-- Pencarian --}}
                                <div>
                                    <label for="search" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                        <div class="flex items-center space-x-2">
                                            <i data-lucide="search" class="w-4 h-4 text-blue-500"></i>
                                            <span>Cari</span>
                                        </div>
                                    </label>
                                    <input type="text" id="search" name="search"
                                        value="{{ request('search') }}"
                                        placeholder="Cari deskripsi/jumlah..."
                                        class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                </div>
                            </div>

                            {{-- Filter Buttons --}}
                            <div class="flex items-center justify-end mt-6 space-x-3">
                                <a href="{{ route('reports.financial') }}"
                                    class="group flex items-center px-6 py-3 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white font-medium rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-all duration-200">
                                    <i data-lucide="refresh-cw" class="w-4 h-4 mr-2 group-hover:rotate-180 transition-transform"></i>
                                    Reset
                                </a>
                                <button type="submit"
                                    class="group flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                    <i data-lucide="filter" class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform"></i>
                                    Filter
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Table Section --}}
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-slate-200 dark:border-slate-700">
                                        <th class="text-left py-4 px-6 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="calendar" class="w-4 h-4"></i>
                                                <span>Tanggal</span>
                                            </div>
                                        </th>
                                        <th class="text-left py-4 px-6 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="activity" class="w-4 h-4"></i>
                                                <span>Tipe</span>
                                            </div>
                                        </th>
                                        <th class="text-right py-4 px-6 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center justify-end space-x-2">
                                                <i data-lucide="dollar-sign" class="w-4 h-4"></i>
                                                <span>Jumlah</span>
                                            </div>
                                        </th>
                                        <th class="text-left py-4 px-6 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="file-text" class="w-4 h-4"></i>
                                                <span>Deskripsi</span>
                                            </div>
                                        </th>
                                        <th class="text-left py-4 px-6 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="user" class="w-4 h-4"></i>
                                                <span>Dicatat Oleh</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                    @forelse ($transactions as $transaction)
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors duration-200">
                                            <td class="py-4 px-6">
                                                <span class="text-slate-600 dark:text-slate-400">
                                                    {{ $transaction->transaction_date->format('d M Y') }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-6">
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                                    {{ $transaction->type == 'kredit' 
                                                        ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/20 dark:text-emerald-300' 
                                                        : 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300' }}">
                                                    {{ ucfirst($transaction->type) }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-6 text-right">
                                                <span class="font-semibold text-slate-900 dark:text-white">
                                                    Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-6">
                                                <span class="text-slate-600 dark:text-slate-400">
                                                    {{ $transaction->description }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-6">
                                                <span class="text-slate-600 dark:text-slate-400">
                                                    {{ $transaction->user->name ?? 'N/A' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="py-12 px-6 text-center">
                                                <div class="flex flex-col items-center space-y-4">
                                                    <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center">
                                                        <i data-lucide="file-x" class="w-8 h-8 text-slate-400"></i>
                                                    </div>
                                                    <div>
                                                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Tidak ada transaksi</h3>
                                                        <p class="text-slate-600 dark:text-slate-400">Tidak ada transaksi yang sesuai dengan filter</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if($transactions->hasPages())
                            <div class="mt-6 pt-6 border-t border-slate-200 dark:border-slate-700">
                                {{ $transactions->appends(request()->except('page'))->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize Lucide icons
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }

                // Animate cards on load
                const animateCards = () => {
                    const cards = document.querySelectorAll('.group.relative');
                    cards.forEach((card, index) => {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(30px)';
                        card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';

                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, index * 150);
                    });
                };

                // Start animations
                setTimeout(animateCards, 200);
            });
        </script>
    @endpush
</x-app-layout>
