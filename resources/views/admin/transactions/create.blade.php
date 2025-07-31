{{-- resources/views/admin/transactions/create.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center space-x-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white leading-tight">
                        Tambah Transaksi Baru
                    </h2>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                        Catat transaksi keuangan baru
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            {{-- Main Content Card --}}
            <div class="group relative">
                <div class="absolute inset-0 bg-slate-100 dark:bg-slate-800 rounded-2xl opacity-75 group-hover:opacity-100 blur-sm group-hover:blur-none transition-all duration-300"></div>
                <div class="relative bg-white dark:bg-slate-900 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 border border-slate-200 dark:border-slate-700">
                    <form action="{{ route('transactions.store') }}" method="POST">
                        @csrf

                        {{-- Header Section --}}
                        <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                                    <i data-lucide="plus-circle" class="w-5 h-5 text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Form Transaksi Baru</h3>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">Isi informasi transaksi di bawah ini</p>
                                </div>
                            </div>
                        </div>

                        {{-- Form Section --}}
                        <div class="p-6">
                            {{-- Transaction Date --}}
                            <div class="mb-6">
                                <label for="transaction_date" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                    <div class="flex items-center space-x-2">
                                        <i data-lucide="calendar" class="w-4 h-4 text-blue-500"></i>
                                        <span>Tanggal Transaksi</span>
                                    </div>
                                </label>
                                <input type="date" id="transaction_date" name="transaction_date" 
                                    value="{{ old('transaction_date', date('Y-m-d')) }}"
                                    class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                    required>
                                @error('transaction_date')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Transaction Type --}}
                            <div class="mb-6">
                                <label for="type" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                    <div class="flex items-center space-x-2">
                                        <i data-lucide="activity" class="w-4 h-4 text-blue-500"></i>
                                        <span>Tipe Transaksi</span>
                                    </div>
                                </label>
                                <select id="type" name="type"
                                    class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                    required>
                                    <option value="">Pilih Tipe</option>
                                    <option value="kredit" {{ old('type') == 'kredit' ? 'selected' : '' }}>Kredit (Pemasukan)</option>
                                    <option value="debit" {{ old('type') == 'debit' ? 'selected' : '' }}>Debit (Pengeluaran)</option>
                                </select>
                                @error('type')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Amount --}}
                            <div class="mb-6">
                                <label for="amount" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                    <div class="flex items-center space-x-2">
                                        <i data-lucide="dollar-sign" class="w-4 h-4 text-blue-500"></i>
                                        <span>Jumlah Nominal</span>
                                    </div>
                                </label>
                                <input type="number" id="amount" name="amount" step="0.01"
                                    value="{{ old('amount') }}"
                                    class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                    placeholder="Masukkan jumlah nominal" required min="0">
                                @error('amount')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div class="mb-6">
                                <label for="description" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                    <div class="flex items-center space-x-2">
                                        <i data-lucide="file-text" class="w-4 h-4 text-blue-500"></i>
                                        <span>Deskripsi Transaksi</span>
                                    </div>
                                </label>
                                <textarea id="description" name="description" rows="4"
                                    class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none"
                                    placeholder="Jelaskan detail transaksi ini" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex items-center justify-between pt-6 border-t border-slate-200 dark:border-slate-700">
                                <a href="{{ route('transactions.index') }}"
                                   class="group flex items-center px-6 py-3 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white font-medium rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-all duration-200">
                                    <i data-lucide="arrow-left" class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform"></i>
                                    Kembali ke Daftar
                                </a>
                                <button type="submit"
                                        class="group flex items-center px-8 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                    <i data-lucide="save" class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform"></i>
                                    Simpan Transaksi
                                </button>
                            </div>
                        </div>
                    </form>
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

                // Add form validation feedback
                const inputs = document.querySelectorAll('input, textarea, select');
                inputs.forEach(input => {
                    input.addEventListener('focus', function() {
                        this.parentElement.classList.add('ring-2', 'ring-blue-500');
                    });
                    
                    input.addEventListener('blur', function() {
                        this.parentElement.classList.remove('ring-2', 'ring-blue-500');
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
