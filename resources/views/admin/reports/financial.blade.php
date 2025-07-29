{{-- resources/views/admin/reports/financial.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Keuangan Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Summary Cards Laporan --}}
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Ringkasan Keuangan Periode Ini
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                    <div class="bg-green-500 dark:bg-green-700 text-white p-4 rounded-lg shadow-md">
                        <div class="text-sm font-medium">Total Pemasukan</div>
                        <div class="text-2xl font-bold mt-1">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
                    </div>
                    <div class="bg-red-500 dark:bg-red-700 text-white p-4 rounded-lg shadow-md">
                        <div class="text-sm font-medium">Total Pengeluaran</div>
                        <div class="text-2xl font-bold mt-1">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="bg-blue-500 dark:bg-blue-700 text-white p-4 rounded-lg shadow-md">
                        <div class="text-sm font-medium">Laba/Rugi Bersih</div>
                        <div class="text-2xl font-bold mt-1">Rp {{ number_format($labaRugiBersih, 0, ',', '.') }}</div>
                    </div>
                </div>

                {{-- Filter dan Pencarian --}}
                <form action="{{ route('reports.financial') }}" method="GET"
                    class="mb-6 bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-inner">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <x-input-label for="type_filter" :value="__('Tipe Transaksi')" />
                            <select id="type_filter" name="type"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Semua Tipe</option>
                                <option value="kredit" {{ request('type') == 'kredit' ? 'selected' : '' }}>Kredit
                                    (Pemasukan)</option>
                                <option value="debit" {{ request('type') == 'debit' ? 'selected' : '' }}>Debit
                                    (Pengeluaran)</option>
                            </select>
                        </div>
                        <div>
                            <x-input-label for="start_date" :value="__('Dari Tanggal')" />
                            <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date"
                                :value="request('start_date')" />
                        </div>
                        <div>
                            <x-input-label for="end_date" :value="__('Sampai Tanggal')" />
                            <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date"
                                :value="request('end_date')" />
                        </div>
                        <div>
                            <x-input-label for="search" :value="__('Cari Deskripsi/Jumlah')" />
                            <x-text-input id="search" class="block mt-1 w-full" type="text" name="search"
                                :value="request('search')" placeholder="Cari..." />
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <x-primary-button class="mr-2">Filter</x-primary-button>
                        <a href="{{ route('reports.financial') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:bg-gray-300 dark:focus:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Reset</a>
                    </div>
                </form>

                {{-- Export/Import Buttons --}}
                <div class="flex justify-end space-x-2 mb-4">
                    <a href="{{ route('reports.financial.export', request()->all()) }}"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md">
                        Ekspor ke Excel
                    </a>
                    <a href="{{ route('reports.financial.import') }}"
                        class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-md">
                        Impor dari Excel
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-700 rounded-lg shadow-md">
                        <thead>
                            <tr
                                class="bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Tanggal</th>
                                <th class="py-3 px-6 text-left">Tipe</th>
                                <th class="py-3 px-6 text-right">Jumlah</th>
                                <th class="py-3 px-6 text-left">Deskripsi</th>
                                <th class="py-3 px-6 text-left">Dicatat Oleh</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 dark:text-gray-300 text-sm font-light">
                            @forelse ($transactions as $transaction)
                                <tr
                                    class="border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        {{ $transaction->transaction_date->format('d M Y') }}</td>
                                    <td class="py-3 px-6 text-left">
                                        <span
                                            class="px-2 py-1 rounded-full text-xs font-semibold
                                            {{ $transaction->type == 'kredit' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                            {{ ucfirst($transaction->type) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-right whitespace-nowrap">Rp
                                        {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                    <td class="py-3 px-6 text-left">{{ $transaction->description }}</td>
                                    <td class="py-3 px-6 text-left">{{ $transaction->user->name ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-3 px-6 text-center">Tidak ada transaksi yang sesuai
                                        dengan filter.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $transactions->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
