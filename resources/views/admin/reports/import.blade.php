{{-- resources/views/admin/reports/import.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Impor Transaksi dari Excel') }}
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
                        <p class="font-bold">Terjadi kesalahan saat impor:</p>
                        <ul class="list-disc list-inside mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <p class="mb-4 text-gray-600 dark:text-gray-300">
                    Silakan unggah file Excel (.xlsx, .xls, .csv) yang berisi data transaksi.
                    Pastikan kolom-kolomnya sesuai dengan format: **Tanggal Transaksi, Tipe, Jumlah, Deskripsi**.
                    <br>
                    Contoh format kolom:
                <ul class="list-disc list-inside ml-4 mt-2 text-sm">
                    <li>**Tanggal Transaksi:** (misal: 2024-07-29)</li>
                    <li>**Tipe:** (isi 'kredit' atau 'debit')</li>
                    <li>**Jumlah:** (misal: 1500000.00)</li>
                    <li>**Deskripsi:** (misal: Penjualan Meja Jati)</li>
                </ul>
                </p>

                <form action="{{ route('reports.financial.do_import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="file" :value="__('Pilih File Excel')" />
                        <input type="file" id="file" name="file"
                            class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100 dark:file:bg-blue-700 dark:file:text-white dark:hover:file:bg-blue-600"
                            required />
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Hanya format .xlsx, .xls, .csv</p>
                        <x-input-error :messages="$errors->get('file')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('reports.financial') }}"
                            class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mr-4">Batal</a>
                        <x-primary-button>
                            {{ __('Impor Transaksi') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
