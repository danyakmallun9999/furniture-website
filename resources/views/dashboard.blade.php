{{-- resources/views/dashboard.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Section Ringkasan Keuangan (Cards) --}}
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Ringkasan Keuangan Anda (Bulan
                    Ini)</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                    {{-- Card Pemasukan --}}
                    <div class="bg-green-500 dark:bg-green-700 text-white p-4 rounded-lg shadow-md">
                        <div class="text-sm font-medium">Total Pemasukan</div>
                        <div class="text-2xl font-bold mt-1">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
                        {{-- Ambil dari controller --}}
                    </div>
                    {{-- Card Pengeluaran --}}
                    <div class="bg-red-500 dark:bg-red-700 text-white p-4 rounded-lg shadow-md">
                        <div class="text-sm font-medium">Total Pengeluaran</div>
                        <div class="text-2xl font-bold mt-1">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                        </div> {{-- Ambil dari controller --}}
                    </div>
                    {{-- Card Laba/Rugi Bersih --}}
                    <div class="bg-blue-500 dark:bg-blue-700 text-white p-4 rounded-lg shadow-md">
                        <div class="text-sm font-medium">Laba/Rugi Bersih</div>
                        <div class="text-2xl font-bold mt-1">Rp {{ number_format($labaRugiBersih, 0, ',', '.') }}</div>
                        {{-- Ambil dari controller --}}
                    </div>
                </div>

                {{-- Section Chart --}}
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Grafik Transaksi Bulanan (Tahun
                    Ini)</h3>
                <div class="bg-gray-700 p-4 rounded-lg shadow-md">
                    <canvas id="monthlyTransactionChart" style="max-height: 400px;"></canvas>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Data chart diambil dari variabel PHP yang dikirim dari controller
                const monthlyIncomeData = @json($monthlyIncomeData);
                const monthlyExpenseData = @json($monthlyExpenseData);
                const months = @json($months);

                const ctx = document.getElementById('monthlyTransactionChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: months,
                        datasets: [{
                                label: 'Pemasukan',
                                data: monthlyIncomeData,
                                backgroundColor: 'rgba(75, 192, 192, 0.8)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Pengeluaran',
                                data: monthlyExpenseData,
                                backgroundColor: 'rgba(255, 99, 132, 0.8)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + value.toLocaleString('id-ID'); // Format mata uang
                                    }
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        label += 'Rp ' + context.parsed.y.toLocaleString(
                                            'id-ID'); // Format mata uang di tooltip
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
