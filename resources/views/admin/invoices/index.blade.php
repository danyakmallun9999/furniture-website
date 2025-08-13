{{-- resources/views/admin/invoices/index.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center space-x-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white leading-tight">
                        Manajemen Invoice
                    </h2>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                        Kelola semua invoice dan pembayaran pelanggan
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Success Message --}}
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

            {{-- Main Content Card --}}
            <div class="group relative">
                <div class="absolute inset-0 bg-slate-100 dark:bg-slate-800 rounded-2xl opacity-75 group-hover:opacity-100 blur-sm group-hover:blur-none transition-all duration-300"></div>
                <div class="relative bg-white dark:bg-slate-900 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 border border-slate-200 dark:border-slate-700">
                    {{-- Header Section --}}
                    <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-amber-500 to-orange-600 rounded-xl flex items-center justify-center">
                                    <i data-lucide="file-text" class="w-5 h-5 text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Daftar Invoice</h3>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">Kelola semua invoice pelanggan</p>
                                </div>
                            </div>
                            <a href="{{ route('invoices.create') }}"
                                class="group flex items-center px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                <i data-lucide="plus-circle" class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform"></i>
                                Buat Invoice Baru
                            </a>
                        </div>
                    </div>

                    {{-- Filter Section --}}
                    <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                        <form action="{{ route('invoices.index') }}" method="GET">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                {{-- Type Filter --}}
                                <div>
                                    <label for="type_filter" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                        <div class="flex items-center space-x-2">
                                            <i data-lucide="activity" class="w-4 h-4 text-blue-500"></i>
                                            <span>Tipe Invoice</span>
                                        </div>
                                    </label>
                                    <select id="type_filter" name="type"
                                        class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                        <option value="">Semua Tipe</option>
                                        <option value="kredit" {{ request('type') == 'kredit' ? 'selected' : '' }}>Kredit (Pemasukan)</option>
                                        <option value="debit" {{ request('type') == 'debit' ? 'selected' : '' }}>Debit (Pengeluaran)</option>
                                    </select>
                                </div>

                                {{-- Start Date --}}
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

                                {{-- End Date --}}
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

                                {{-- Search --}}
                                <div>
                                    <label for="search" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                        <div class="flex items-center space-x-2">
                                            <i data-lucide="search" class="w-4 h-4 text-blue-500"></i>
                                            <span>Cari</span>
                                        </div>
                                    </label>
                                    <input type="text" id="search" name="search"
                                        value="{{ request('search') }}"
                                        placeholder="Cari nomor/nama/jumlah..."
                                        class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                </div>
                            </div>

                            {{-- Filter Buttons --}}
                            <div class="flex items-center justify-end mt-6 space-x-3">
                                <a href="{{ route('invoices.index') }}"
                                    class="group flex items-center px-6 py-3 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white font-medium rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-all duration-200">
                                    <i data-lucide="refresh-cw" class="w-4 h-4 mr-2 group-hover:rotate-180 transition-transform"></i>
                                    Reset
                                </a>
                                <button type="submit"
                                    class="group flex items-center px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                    <i data-lucide="filter" class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform"></i>
                                    Filter
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Table Section --}}
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-[1200px] text-sm">
                                <thead>
                                    <tr class="border-b border-slate-200 dark:border-slate-700">
                                        <th class="text-left py-3 px-4 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="hash" class="w-4 h-4"></i>
                                                <span>No Invoice</span>
                                            </div>
                                        </th>
                                        <th class="text-left py-3 px-4 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="image" class="w-4 h-4"></i>
                                                <span>Foto</span>
                                            </div>
                                        </th>
                                        <th class="text-left py-3 px-4 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="user" class="w-4 h-4"></i>
                                                <span>Pelanggan</span>
                                            </div>
                                        </th>
                                        <th class="text-left py-3 px-4 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="calendar" class="w-4 h-4"></i>
                                                <span>Tanggal</span>
                                            </div>
                                        </th>
                                        <th class="text-left py-3 px-4 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="clock" class="w-4 h-4"></i>
                                                <span>Tempo</span>
                                            </div>
                                        </th>
                                        <th class="text-left py-3 px-4 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="activity" class="w-4 h-4"></i>
                                                <span>Tipe</span>
                                            </div>
                                        </th>
                                        <th class="text-right py-3 px-4 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center justify-end space-x-2">
                                                <i data-lucide="dollar-sign" class="w-4 h-4"></i>
                                                <span>Total</span>
                                            </div>
                                        </th>
                                        <th class="text-center py-3 px-4 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center justify-center space-x-2">
                                                <i data-lucide="activity" class="w-4 h-4"></i>
                                                <span>Status</span>
                                            </div>
                                        </th>
                                        <th class="text-left py-3 px-4 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="user-check" class="w-4 h-4"></i>
                                                <span>Dibuat</span>
                                            </div>
                                        </th>
                                        <th class="text-center py-3 px-4 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center justify-center space-x-2">
                                                <i data-lucide="settings" class="w-4 h-4"></i>
                                                <span>Aksi</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                    @forelse ($invoices as $invoice)
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors duration-200">
                                            <td class="py-3 px-4">
                                                <div class="flex items-center space-x-3">
                                                    <div class="w-8 h-8 bg-gradient-to-r from-amber-500 to-orange-600 rounded-lg flex items-center justify-center">
                                                        <i data-lucide="file-text" class="w-4 h-4 text-white"></i>
                                                    </div>
                                                    <span class="font-medium text-slate-900 dark:text-white">{{ $invoice->invoice_number }}</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-4">
                                                @if($invoice->receipt_image_path)
                                                    <img src="{{ asset('storage/'.$invoice->receipt_image_path) }}" alt="Nota" class="w-12 h-12 object-cover rounded-lg border border-slate-200 dark:border-slate-700">
                                                @else
                                                    <div class="w-12 h-12 rounded-lg border border-dashed border-slate-300 dark:border-slate-700 flex items-center justify-center text-slate-400">
                                                        <i data-lucide="image-off" class="w-5 h-5"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="py-3 px-4">
                                                <span class="text-slate-600 dark:text-slate-400">{{ $invoice->customer->name ?? 'N/A' }}</span>
                                            </td>
                                            <td class="py-3 px-4">
                                                <span class="text-slate-600 dark:text-slate-400">{{ $invoice->invoice_date->format('d M Y') }}</span>
                                            </td>
                                            <td class="py-3 px-4">
                                                <span class="text-slate-600 dark:text-slate-400">
                                                    {{ $invoice->due_date ? $invoice->due_date->format('d M Y') : '-' }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-4">
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                                    @if ($invoice->type == 'kredit') 
                                                        bg-emerald-100 text-emerald-800 dark:bg-emerald-900/20 dark:text-emerald-300
                                                    @elseif ($invoice->type == 'pending') 
                                                        bg-amber-100 text-amber-800 dark:bg-amber-900/20 dark:text-amber-300
                                                    @else 
                                                        bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300 
                                                    @endif">
                                                    {{ ucfirst($invoice->type) }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-4 text-right">
                                                <span class="font-semibold text-slate-900 dark:text-white">
                                                    Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-4 text-center">
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                                    @if ($invoice->payment_status == 'paid') 
                                                        bg-emerald-100 text-emerald-800 dark:bg-emerald-900/20 dark:text-emerald-300
                                                    @elseif ($invoice->payment_status == 'pending') 
                                                        bg-amber-100 text-amber-800 dark:bg-amber-900/20 dark:text-amber-300
                                                    @else 
                                                        bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300 
                                                    @endif">
                                                    {{ ucfirst($invoice->payment_status) }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-4">
                                                <span class="text-slate-600 dark:text-slate-400">{{ $invoice->user->name ?? 'N/A' }}</span>
                                            </td>
                                            <td class="py-3 px-4">
                                                <div class="flex items-center justify-center space-x-2">
                                                    <a href="{{ route('invoices.show', $invoice->id) }}"
                                                        class="group p-2 rounded-xl bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-all duration-200 transform hover:scale-110"
                                                        title="Lihat">
                                                        <i data-lucide="eye" class="w-4 h-4 text-blue-600 dark:text-blue-400 group-hover:text-blue-700 dark:group-hover:text-blue-300"></i>
                                                    </a>
                                                    <a href="{{ route('invoices.edit', $invoice->id) }}"
                                                        class="group p-2 rounded-xl bg-purple-50 dark:bg-purple-900/20 hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-all duration-200 transform hover:scale-110"
                                                        title="Edit">
                                                        <i data-lucide="edit-3" class="w-4 h-4 text-purple-600 dark:text-purple-400 group-hover:text-purple-700 dark:group-hover:text-purple-300"></i>
                                                    </a>
                                                    <form action="{{ route('invoices.destroy', $invoice->id) }}" 
                                                          method="POST"
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus invoice ini?');"
                                                          class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="group p-2 rounded-xl bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 transition-all duration-200 transform hover:scale-110"
                                                                title="Hapus">
                                                            <i data-lucide="trash-2" class="w-4 h-4 text-red-600 dark:text-red-400 group-hover:text-red-700 dark:group-hover:text-red-300"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="py-12 px-6 text-center">
                                                <div class="flex flex-col items-center space-y-4">
                                                    <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center">
                                                        <i data-lucide="file-x" class="w-8 h-8 text-slate-400"></i>
                                                    </div>
                                                    <div>
                                                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Tidak ada invoice</h3>
                                                        <p class="text-slate-600 dark:text-slate-400">Mulai dengan membuat invoice pertama Anda</p>
                                                    </div>
                                                    <a href="{{ route('invoices.create') }}"
                                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-medium rounded-lg transition-all duration-200">
                                                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                                                        Buat Invoice Pertama
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if($invoices->hasPages())
                            <div class="mt-6 pt-6 border-t border-slate-200 dark:border-slate-700">
                                {{ $invoices->appends(request()->except('page'))->links() }}
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
