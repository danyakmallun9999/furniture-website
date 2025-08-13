{{-- resources/views/dashboard.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center space-x-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white leading-tight">
                        Dashboard Admin
                    </h2>
                </div>
            </div>
            {{-- filter form moved below chart card --}}
        </div>
    </x-slot>

    {{-- Hero Stats Section --}}
    <div class="mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Total Pemasukan --}}
            <div class="group relative">
                <div
                    class="absolute inset-0 bg-slate-100 dark:bg-slate-800 rounded-2xl opacity-75 group-hover:opacity-100 blur-sm group-hover:blur-none transition-all duration-300">
                </div>
                <div
                    class="relative bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 border border-slate-200 dark:border-slate-700">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                            <i data-lucide="trending-up" class="w-5 h-5 text-white"></i>
                        </div>
                        <div
                            class="flex items-center space-x-1 text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20 px-2 py-1 rounded-full">
                            <i data-lucide="arrow-up" class="w-3 h-3"></i>
                            <span class="text-xs font-semibold">Bulan Ini</span>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-sm font-medium text-slate-600 dark:text-slate-400 uppercase tracking-wider">
                            Total Pemasukan
                        </h3>
                        <p class="text-3xl font-bold text-slate-900 dark:text-white">
                            Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                        </p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 flex items-center">
                            <i data-lucide="calendar" class="w-3 h-3 mr-1"></i>
                            {{ now()->format('F Y') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Total Pengeluaran --}}
            <div class="group relative">
                <div
                    class="absolute inset-0 bg-slate-100 dark:bg-slate-800 rounded-2xl opacity-75 group-hover:opacity-100 blur-sm group-hover:blur-none transition-all duration-300">
                </div>
                <div
                    class="relative bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 border border-slate-200 dark:border-slate-700">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-10 h-10 bg-red-500 rounded-xl flex items-center justify-center shadow-lg">
                            <i data-lucide="trending-down" class="w-5 h-5 text-white"></i>
                        </div>
                        <div
                            class="flex items-center space-x-1 text-red-600 bg-red-50 dark:bg-red-900/20 px-2 py-1 rounded-full">
                            <i data-lucide="arrow-down" class="w-3 h-3"></i>
                            <span class="text-xs font-semibold">Bulan Ini</span>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-sm font-medium text-slate-600 dark:text-slate-400 uppercase tracking-wider">
                            Total Pengeluaran
                        </h3>
                        <p class="text-3xl font-bold text-slate-900 dark:text-white">
                            Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                        </p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 flex items-center">
                            <i data-lucide="calendar" class="w-3 h-3 mr-1"></i>
                            {{ now()->format('F Y') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Laba/Rugi Bersih --}}
            <div class="group relative">
                <div
                    class="absolute inset-0 bg-slate-100 dark:bg-slate-800 rounded-2xl opacity-75 group-hover:opacity-100 blur-sm group-hover:blur-none transition-all duration-300">
                </div>
                <div
                    class="relative bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 border border-slate-200 dark:border-slate-700">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-10 h-10 bg-violet-600 rounded-xl flex items-center justify-center shadow-lg">
                            <i data-lucide="wallet" class="w-5 h-5 text-white"></i>
                        </div>
                        <div
                            class="flex items-center space-x-1 {{ $labaRugiBersih >= 0 ? 'text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20' : 'text-red-600 bg-red-50 dark:bg-red-900/20' }} px-2 py-1 rounded-full">
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
                        <p class="text-xs text-slate-500 dark:text-slate-400 flex items-center">
                            <i data-lucide="calendar" class="w-3 h-3 mr-1"></i>
                            {{ now()->format('F Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content Grid --}}
    <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">
        {{-- Chart Section --}}
        <div class="xl:col-span-3 space-y-6">
            {{-- Filter controls (card) --}}
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700">
                <div class="p-6">
                    <form method="GET" action="{{ route('dashboard') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        {{-- Granularity --}}
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Granularitas</label>
                            <div class="relative">
                                <select name="granularity" class="appearance-none w-full text-sm border border-slate-200 dark:border-slate-600 rounded-xl px-3 pr-10 py-2 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    <option value="month" {{ ($granularity ?? 'month') === 'month' ? 'selected' : '' }}>Bulanan</option>
                                    <option value="quarter" {{ ($granularity ?? 'month') === 'quarter' ? 'selected' : '' }}>Kuartal</option>
                                    <option value="year" {{ ($granularity ?? 'month') === 'year' ? 'selected' : '' }}>Tahunan</option>
                                </select>
                                <i data-lucide="chevron-down" class="w-4 h-4 absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                            </div>
                        </div>
                        {{-- Year --}}
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Tahun</label>
                            <div class="relative">
                                <select name="year" class="appearance-none w-full text-sm border border-slate-200 dark:border-slate-600 rounded-xl px-3 pr-10 py-2 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    @for ($y = now()->year; $y >= now()->year - 9; $y--)
                                        <option value="{{ $y }}" {{ ($selectedYear ?? now()->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                                    @endfor
                                </select>
                                <i data-lucide="chevron-down" class="w-4 h-4 absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                            </div>
                        </div>
                        {{-- Apply --}}
                        <div class="flex items-end">
                            <button type="submit" class="w-full sm:w-auto px-4 py-2 text-sm rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300">Terapkan</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Transaction Chart Card --}}
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-xl overflow-hidden">
                <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white flex items-center">
                                <i data-lucide="bar-chart-3" class="w-5 h-5 mr-2 text-indigo-600"></i>
                                Grafik Transaksi ({{ strtoupper($granularity ?? 'month') }}) - {{ $selectedYear ?? now()->year }}
                            </h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                                Perbandingan pemasukan dan pengeluaran
                            </p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button id="downloadChart"
                                class="p-2 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors"
                                title="Unduh grafik">
                                <i data-lucide="download" class="w-4 h-4 text-slate-600 dark:text-slate-400"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="relative">
                        <canvas id="monthlyTransactionChart" class="w-full" style="height: 400px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Sidebar --}}
        <div class="xl:col-span-1 space-y-6">
            {{-- Quick Actions --}}
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-xl p-6">
                <div class="flex items-center mb-6">
                    <i data-lucide="zap" class="w-5 h-5 text-amber-500 mr-2"></i>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Aksi Cepat</h3>
                </div>

                <div class="space-y-3">
                    <a href="{{ route('invoices.create') }}"
                        class="group flex items-center p-4 rounded-xl bg-white dark:bg-slate-900 border border-emerald-100 dark:border-emerald-800 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 transition-all duration-200">
                        <div
                            class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-cyan-600 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                            <i data-lucide="plus-circle" class="w-5 h-5 text-white"></i>
                        </div>
                        <div class="flex-1">
                            <p
                                class="font-semibold text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400">
                                Transaksi Baru</p>
                            <p class="text-xs text-slate-600 dark:text-slate-400">Buat Transaksi penjualan</p>
                        </div>
                        <i data-lucide="arrow-right"
                            class="w-4 h-4 text-slate-400 group-hover:text-emerald-600 group-hover:translate-x-1 transition-all"></i>
                    </a>

                    <a href="{{ route('products.create') }}"
                        class="group flex items-center p-4 rounded-xl bg-white dark:bg-slate-900 border border-blue-100 dark:border-blue-800 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all duration-200">
                        <div
                            class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                            <i data-lucide="package-plus" class="w-5 h-5 text-white"></i>
                        </div>
                        <div class="flex-1">
                            <p
                                class="font-semibold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400">
                                Produk Baru</p>
                            <p class="text-xs text-slate-600 dark:text-slate-400">Tambah produk mebel</p>
                        </div>
                        <i data-lucide="arrow-right"
                            class="w-4 h-4 text-slate-400 group-hover:text-blue-600 group-hover:translate-x-1 transition-all"></i>
                    </a>

                    <a href="{{ route('reports.financial') }}"
                        class="group flex items-center p-4 rounded-xl bg-white dark:bg-slate-900 border border-purple-100 dark:border-purple-800 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-all duration-200">
                        <div
                            class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                            <i data-lucide="file-bar-chart" class="w-5 h-5 text-white"></i>
                        </div>
                        <div class="flex-1">
                            <p
                                class="font-semibold text-slate-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-400">
                                Laporan Keuangan</p>
                            <p class="text-xs text-slate-600 dark:text-slate-400">Analisis mendalam</p>
                        </div>
                        <i data-lucide="arrow-right"
                            class="w-4 h-4 text-slate-400 group-hover:text-purple-600 group-hover:translate-x-1 transition-all"></i>
                    </a>

                    <a href="{{ route('invoices.index') }}"
                        class="group flex items-center p-4 rounded-xl bg-white dark:bg-slate-900 border border-amber-100 dark:border-amber-800 hover:bg-amber-50 dark:hover:bg-amber-900/20 transition-all duration-200">
                        <div
                            class="w-10 h-10 bg-gradient-to-r from-amber-500 to-orange-600 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                            <i data-lucide="file-text" class="w-5 h-5 text-white"></i>
                        </div>
                        <div class="flex-1">
                            <p
                                class="font-semibold text-slate-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400">
                                Kelola Transaksi</p>
                            <p class="text-xs text-slate-600 dark:text-slate-400">Buat & kelola invoice</p>
                        </div>
                        <i data-lucide="arrow-right"
                            class="w-4 h-4 text-slate-400 group-hover:text-amber-600 group-hover:translate-x-1 transition-all"></i>
                    </a>
                </div>
            </div>

            {{-- Quick Stats --}}
            {{-- <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-xl p-6">
                <div class="flex items-center mb-6">
                    <i data-lucide="trending-up" class="w-5 h-5 text-blue-500 mr-2"></i>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Statistik Cepat</h3>
                </div>

                <div class="space-y-4">
                    <div
                        class="flex items-center justify-between p-3 rounded-xl bg-blue-50 dark:bg-blue-900/10 border border-blue-100 dark:border-blue-800">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                <i data-lucide="users" class="w-4 h-4 text-white"></i>
                            </div>
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Total Pelanggan</span>
                        </div>
                        <span class="text-lg font-bold text-slate-900 dark:text-white">127</span>
                    </div>

                    <div
                        class="flex items-center justify-between p-3 rounded-xl bg-green-50 dark:bg-green-900/10 border border-green-100 dark:border-green-800">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                                <i data-lucide="shopping-cart" class="w-4 h-4 text-white"></i>
                            </div>
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Transaksi Bulan
                                Ini</span>
                        </div>
                        <span
                            class="text-lg font-bold text-slate-900 dark:text-white">{{ collect($monthlyIncomeData)->sum() > 0 ? '24' : '0' }}</span>
                    </div>

                    <div
                        class="flex items-center justify-between p-3 rounded-xl bg-purple-50 dark:bg-purple-900/10 border border-purple-100 dark:border-purple-800">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center">
                                <i data-lucide="package" class="w-4 h-4 text-white"></i>
                            </div>
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Produk Aktif</span>
                        </div>
                        <span class="text-lg font-bold text-slate-900 dark:text-white">89</span>
                    </div>

                    <div
                        class="flex items-center justify-between p-3 rounded-xl bg-amber-50 dark:bg-amber-900/10 border border-amber-100 dark:border-amber-800">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-amber-500 rounded-lg flex items-center justify-center">
                                <i data-lucide="file-text" class="w-4 h-4 text-white"></i>
                            </div>
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Invoice Pending</span>
                        </div>
                        <span class="text-lg font-bold text-slate-900 dark:text-white">5</span>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize Lucide icons
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }

                // Animate cards on load
                const animateCards = () => {
                    const cards = document.querySelectorAll('.group');
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

                // Chart data from controller
                const monthlyIncomeData = @json($monthlyIncomeData);
                const monthlyExpenseData = @json($monthlyExpenseData);
                const months = @json($months);

                // Create Chart
                const ctx = document.getElementById('monthlyTransactionChart').getContext('2d');

                // Create gradients
                const incomeGradient = ctx.createLinearGradient(0, 0, 0, 400);
                incomeGradient.addColorStop(0, 'rgba(16, 185, 129, 0.8)');
                incomeGradient.addColorStop(0.5, 'rgba(16, 185, 129, 0.4)');
                incomeGradient.addColorStop(1, 'rgba(16, 185, 129, 0.1)');

                const expenseGradient = ctx.createLinearGradient(0, 0, 0, 400);
                expenseGradient.addColorStop(0, 'rgba(239, 68, 68, 0.8)');
                expenseGradient.addColorStop(0.5, 'rgba(239, 68, 68, 0.4)');
                expenseGradient.addColorStop(1, 'rgba(239, 68, 68, 0.1)');

                const chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Pemasukan',
                            data: monthlyIncomeData,
                            backgroundColor: incomeGradient,
                            borderColor: 'rgb(16, 185, 129)',
                            borderWidth: 2,
                            borderRadius: 12,
                            borderSkipped: false,
                            barThickness: 'flex',
                            maxBarThickness: 60,
                        }, {
                            label: 'Pengeluaran',
                            data: monthlyExpenseData,
                            backgroundColor: expenseGradient,
                            borderColor: 'rgb(239, 68, 68)',
                            borderWidth: 2,
                            borderRadius: 12,
                            borderSkipped: false,
                            barThickness: 'flex',
                            maxBarThickness: 60,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            intersect: false,
                            mode: 'index',
                        },
                        layout: {
                            padding: {
                                top: 20,
                                bottom: 20
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                                align: 'end',
                                labels: {
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    padding: 25,
                                    font: {
                                        size: 13,
                                        weight: '600',
                                        family: 'Inter'
                                    },
                                    color: '#64748b'
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(15, 23, 42, 0.95)',
                                titleColor: '#f8fafc',
                                bodyColor: '#f8fafc',
                                borderColor: 'rgba(148, 163, 184, 0.2)',
                                borderWidth: 1,
                                cornerRadius: 16,
                                displayColors: true,
                                padding: 16,
                                titleFont: {
                                    size: 14,
                                    weight: '600'
                                },
                                bodyFont: {
                                    size: 13,
                                    weight: '500'
                                },
                                callbacks: {
                                    title: function(context) {
                                        return 'Bulan ' + context[0].label;
                                    },
                                    label: function(context) {
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                        return label;
                                    },
                                    afterBody: function(context) {
                                        const income = context.find(item => item.datasetIndex === 0)?.parsed
                                            .y || 0;
                                        const expense = context.find(item => item.datasetIndex === 1)
                                            ?.parsed.y || 0;
                                        const profit = income - expense;
                                        return `\nLaba Bersih: Rp ${profit.toLocaleString('id-ID')}`;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false,
                                },
                                ticks: {
                                    color: '#64748b',
                                    font: {
                                        size: 12,
                                        weight: '500',
                                        family: 'Inter'
                                    },
                                    padding: 10
                                },
                                border: {
                                    display: false
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(148, 163, 184, 0.08)',
                                    drawBorder: false,
                                },
                                ticks: {
                                    color: '#64748b',
                                    font: {
                                        size: 12,
                                        weight: '500',
                                        family: 'Inter'
                                    },
                                    padding: 15,
                                    callback: function(value) {
                                        return 'Rp ' + value.toLocaleString('id-ID');
                                    }
                                },
                                border: {
                                    display: false
                                }
                            }
                        },
                        elements: {
                            bar: {
                                borderWidth: 2,
                            }
                        },
                        animation: {
                            duration: 2000,
                            easing: 'easeOutQuart'
                        }
                    }
                });

                // Animate chart bars after load
                setTimeout(() => {
                    chart.update('active');
                }, 500);

                // Start animations
                setTimeout(animateCards, 200);

                // Add loading state simulation for demo
                const simulateLoading = () => {
                    const cards = document.querySelectorAll('.group.relative');
                    cards.forEach(card => {
                        const content = card.querySelector('.relative');
                        content.style.opacity = '0.6';
                        content.style.pointerEvents = 'none';

                        setTimeout(() => {
                            content.style.opacity = '1';
                            content.style.pointerEvents = 'auto';
                        }, 1000);
                    });
                };

                // Add click handlers for demonstration
                document.addEventListener('click', function(e) {
                    if (e.target.closest('.group.relative')) {
                        const card = e.target.closest('.group.relative');
                        card.style.transform = 'scale(0.98)';
                        setTimeout(() => {
                            card.style.transform = 'scale(1)';
                        }, 150);
                    }
                });

                // Download chart as PNG
                document.getElementById('downloadChart')?.addEventListener('click', function() {
                    const link = document.createElement('a');
                    link.download = `grafik-transaksi-{{ $granularity ?? 'month' }}-{{ $selectedYear ?? now()->year }}.png`;
                    link.href = chart.toBase64Image('image/png', 1.0);
                    link.click();
                });
            });
        </script>
    @endpush
</x-app-layout>
