{{-- resources/views/admin/invoices/show.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center space-x-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white leading-tight">
                        Detail Invoice - {{ $invoice->invoice_number }}
                    </h2>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                        Lihat detail lengkap invoice dan item-itemnya
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
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
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Invoice #{{ $invoice->invoice_number }}</h3>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">Detail lengkap invoice pelanggan</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="px-4 py-2 rounded-full text-sm font-semibold
                                    @if ($invoice->payment_status == 'paid') 
                                        bg-emerald-100 text-emerald-800 dark:bg-emerald-900/20 dark:text-emerald-300
                                    @elseif ($invoice->payment_status == 'pending') 
                                        bg-amber-100 text-amber-800 dark:bg-amber-900/20 dark:text-amber-300
                                    @else 
                                        bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300 
                                    @endif">
                                    {{ ucfirst($invoice->payment_status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Invoice Information --}}
                    <div class="p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                            {{-- Left Column --}}
                            <div class="space-y-4">
                                <div class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-4">
                                    <h4 class="font-semibold text-slate-900 dark:text-white mb-3 flex items-center">
                                        <i data-lucide="calendar" class="w-4 h-4 mr-2 text-blue-500"></i>
                                        Informasi Invoice
                                    </h4>
                                    <div class="space-y-2">
                                        <div class="flex justify-between">
                                            <span class="text-slate-600 dark:text-slate-400">Tanggal Invoice:</span>
                                            <span class="font-medium text-slate-900 dark:text-white">{{ $invoice->invoice_date->format('d M Y') }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-slate-600 dark:text-slate-400">Jatuh Tempo:</span>
                                            <span class="font-medium text-slate-900 dark:text-white">
                                                {{ $invoice->due_date ? $invoice->due_date->format('d M Y') : '-' }}
                                            </span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-slate-600 dark:text-slate-400">Dibuat Oleh:</span>
                                            <span class="font-medium text-slate-900 dark:text-white">{{ $invoice->user->name ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>

                                @if ($invoice->notes)
                                    <div class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-4">
                                        <h4 class="font-semibold text-slate-900 dark:text-white mb-3 flex items-center">
                                            <i data-lucide="file-text" class="w-4 h-4 mr-2 text-blue-500"></i>
                                            Catatan
                                        </h4>
                                        <p class="text-slate-600 dark:text-slate-400">{{ $invoice->notes }}</p>
                                    </div>
                                @endif
                            </div>

                            {{-- Right Column --}}
                            <div class="space-y-4">
                                <div class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-4">
                                    <h4 class="font-semibold text-slate-900 dark:text-white mb-3 flex items-center">
                                        <i data-lucide="user" class="w-4 h-4 mr-2 text-blue-500"></i>
                                        Detail Pelanggan
                                    </h4>
                                    <div class="space-y-2">
                                        <div class="flex justify-between">
                                            <span class="text-slate-600 dark:text-slate-400">Nama:</span>
                                            <span class="font-medium text-slate-900 dark:text-white">{{ $invoice->customer->name ?? 'N/A' }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-slate-600 dark:text-slate-400">Email:</span>
                                            <span class="font-medium text-slate-900 dark:text-white">{{ $invoice->customer->email ?? '-' }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-slate-600 dark:text-slate-400">Telepon:</span>
                                            <span class="font-medium text-slate-900 dark:text-white">{{ $invoice->customer->phone ?? '-' }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-slate-600 dark:text-slate-400">Alamat:</span>
                                            <span class="font-medium text-slate-900 dark:text-white">{{ $invoice->customer->address ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gradient-to-r from-emerald-500 to-cyan-600 rounded-xl p-4 text-white">
                                    <h4 class="font-semibold mb-3 flex items-center">
                                        <i data-lucide="dollar-sign" class="w-4 h-4 mr-2"></i>
                                        Total Invoice
                                    </h4>
                                    <div class="text-3xl font-bold">
                                        Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Invoice Items Table --}}
                        <div class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-4">
                            <h4 class="font-semibold text-slate-900 dark:text-white mb-4 flex items-center">
                                <i data-lucide="package" class="w-4 h-4 mr-2 text-blue-500"></i>
                                Item-item Invoice
                            </h4>
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="border-b border-slate-200 dark:border-slate-700">
                                            <th class="text-left py-3 px-4 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                                <div class="flex items-center space-x-2">
                                                    <i data-lucide="package" class="w-4 h-4"></i>
                                                    <span>Produk</span>
                                                </div>
                                            </th>
                                            <th class="text-left py-3 px-4 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                                <div class="flex items-center space-x-2">
                                                    <i data-lucide="palette" class="w-4 h-4"></i>
                                                    <span>Motif</span>
                                                </div>
                                            </th>
                                            <th class="text-right py-3 px-4 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                                <div class="flex items-center justify-end space-x-2">
                                                    <i data-lucide="dollar-sign" class="w-4 h-4"></i>
                                                    <span>Harga Satuan</span>
                                                </div>
                                            </th>
                                            <th class="text-center py-3 px-4 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                                <div class="flex items-center justify-center space-x-2">
                                                    <i data-lucide="hash" class="w-4 h-4"></i>
                                                    <span>Kuantitas</span>
                                                </div>
                                            </th>
                                            <th class="text-right py-3 px-4 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                                <div class="flex items-center justify-end space-x-2">
                                                    <i data-lucide="calculator" class="w-4 h-4"></i>
                                                    <span>Subtotal</span>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                        @forelse ($invoice->items as $item)
                                            <tr class="hover:bg-slate-100 dark:hover:bg-slate-700/50 transition-colors duration-200">
                                                <td class="py-3 px-4">
                                                    <span class="font-medium text-slate-900 dark:text-white">{{ $item->product_name_at_sale }}</span>
                                                </td>
                                                <td class="py-3 px-4">
                                                    <span class="text-slate-600 dark:text-slate-400">{{ $item->product_motif_at_sale ?? '-' }}</span>
                                                </td>
                                                <td class="py-3 px-4 text-right">
                                                    <span class="font-medium text-slate-900 dark:text-white">
                                                        Rp {{ number_format($item->unit_price, 0, ',', '.') }}
                                                    </span>
                                                </td>
                                                <td class="py-3 px-4 text-center">
                                                    <span class="text-slate-600 dark:text-slate-400">{{ $item->quantity }}</span>
                                                </td>
                                                <td class="py-3 px-4 text-right">
                                                    <span class="font-semibold text-slate-900 dark:text-white">
                                                        Rp {{ number_format($item->total_item_price, 0, ',', '.') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="py-8 px-4 text-center">
                                                    <div class="flex flex-col items-center space-y-2">
                                                        <i data-lucide="package-x" class="w-8 h-8 text-slate-400"></i>
                                                        <span class="text-slate-500 dark:text-slate-400">Tidak ada item dalam invoice ini.</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center justify-between">
                <a href="{{ route('invoices.index') }}"
                   class="group flex items-center px-6 py-3 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white font-medium rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-all duration-200">
                    <i data-lucide="arrow-left" class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    Kembali ke Daftar
                </a>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('invoices.edit', $invoice->id) }}"
                       class="group flex items-center px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <i data-lucide="edit-3" class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform"></i>
                        Edit Invoice
                    </a>
                    <a href="{{ route('invoices.downloadPdf', $invoice->id) }}"
                       class="group flex items-center px-6 py-3 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200"
                       target="_blank">
                        <i data-lucide="download" class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform"></i>
                        Download PDF
                    </a>
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
