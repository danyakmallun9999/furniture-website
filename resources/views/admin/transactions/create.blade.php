{{-- resources/views/admin/transactions/create.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Transaksi Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="transaction_date" :value="__('Tanggal Transaksi')" />
                        <x-text-input id="transaction_date" class="block mt-1 w-full" type="date"
                            name="transaction_date" :value="old('transaction_date', date('Y-m-d'))" required />
                        <x-input-error :messages="$errors->get('transaction_date')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="type" :value="__('Tipe Transaksi')" />
                        <select id="type" name="type"
                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            required>
                            <option value="">Pilih Tipe</option>
                            <option value="kredit" {{ old('type') == 'kredit' ? 'selected' : '' }}>Kredit (Pemasukan)
                            </option>
                            <option value="debit" {{ old('type') == 'debit' ? 'selected' : '' }}>Debit (Pengeluaran)
                            </option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="amount" :value="__('Jumlah Nominal')" />
                        <x-text-input id="amount" class="block mt-1 w-full" type="number" step="0.01"
                            name="amount" :value="old('amount')" required min="0" />
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Deskripsi Transaksi')" />
                        <x-textarea id="description" class="block mt-1 w-full" name="description"
                            required>{{ old('description') }}</x-textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('transactions.index') }}"
                            class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mr-4">Batal</a>
                        <x-primary-button>
                            {{ __('Simpan Transaksi') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
