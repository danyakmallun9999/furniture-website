{{-- resources/views/admin/invoices/show.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Invoice') }} - {{ $invoice->invoice_number }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 border border-gray-200">

                {{-- Informasi Dasar Invoice --}}
                <div class="mb-8 p-6 bg-gray-50 rounded-lg border border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Invoice #{{ $invoice->invoice_number }}
                            </h3>
                            <p class="text-gray-600">Tanggal Invoice: **{{ $invoice->invoice_date->format('d M Y') }}**
                            </p>
                            <p class="text-gray-600">Tanggal Jatuh Tempo:
                                **{{ $invoice->due_date ? $invoice->due_date->format('d M Y') : '-' }}**</p>
                        </div>
                        <div class="text-right">
                            <p class="text-gray-600">Dibuat Oleh: **{{ $invoice->user->name ?? 'N/A' }}**</p>
                            <p class="text-gray-600">Status Pembayaran:
                                <span
                                    class="px-2 py-1 rounded-full text-sm font-semibold
                                    @if ($invoice->payment_status == 'paid') bg-green-200 text-green-800
                                    @elseif ($invoice->payment_status == 'pending') bg-yellow-200 text-yellow-800
                                    @else bg-red-200 text-red-800 @endif">
                                    {{ ucfirst($invoice->payment_status) }}
                                </span>
                            </p>
                            <p class="text-gray-600">Total Invoice: <span
                                    class="text-2xl font-bold text-primary-dark-green">Rp
                                    {{ number_format($invoice->total_amount, 0, ',', '.') }}</span></p>
                        </div>
                    </div>
                    @if ($invoice->notes)
                        <div class="mt-4 border-t border-gray-200 pt-4">
                            <h4 class="font-semibold text-gray-800 mb-2">Catatan:</h4>
                            <p class="text-gray-600">{{ $invoice->notes }}</p>
                        </div>
                    @endif
                </div>

                {{-- Detail Pelanggan --}}
                <div class="mb-8 p-6 bg-gray-50 rounded-lg border border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Detail Pelanggan</h3>
                    <p class="text-gray-600">Nama: **{{ $invoice->customer->name ?? 'N/A' }}**</p>
                    <p class="text-gray-600">Email: {{ $invoice->customer->email ?? '-' }}</p>
                    <p class="text-gray-600">Telepon: {{ $invoice->customer->phone ?? '-' }}</p>
                    <p class="text-gray-600">Alamat: {{ $invoice->customer->address ?? '-' }}</p>
                </div>

                {{-- Item-item Invoice --}}
                <div class="mb-8 p-6 bg-gray-50 rounded-lg border border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Item-item Invoice</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded-lg shadow-sm border border-gray-200">
                            <thead>
                                <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Produk</th>
                                    <th class="py-3 px-6 text-left">Motif</th>
                                    <th class="py-3 px-6 text-right">Harga Satuan</th>
                                    <th class="py-3 px-6 text-center">Kuantitas</th>
                                    <th class="py-3 px-6 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                @forelse ($invoice->items as $item)
                                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                                        <td class="py-3 px-6 text-left">{{ $item->product_name_at_sale }}</td>
                                        <td class="py-3 px-6 text-left">{{ $item->product_motif_at_sale ?? '-' }}</td>
                                        <td class="py-3 px-6 text-right">Rp
                                            {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                                        <td class="py-3 px-6 text-center">{{ $item->quantity }}</td>
                                        <td class="py-3 px-6 text-right">Rp
                                            {{ number_format($item->total_item_price, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-3 px-6 text-center text-gray-500">Tidak ada item
                                            dalam invoice ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex justify-end space-x-3 mt-6">
                    <a href="{{ route('invoices.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Kembali ke Daftar
                    </a>
                    <a href="{{ route('invoices.edit', $invoice->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Edit Invoice
                    </a>
                    {{-- Tombol Download PDF (Fungsionalitas akan ditambahkan nanti) --}}
                    <a href="{{ route('invoices.downloadPdf', $invoice->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        target="_blank"> {{-- Tambah target="_blank" agar buka di tab baru --}}
                        Download PDF
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
