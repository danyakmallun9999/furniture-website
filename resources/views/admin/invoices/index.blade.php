{{-- resources/views/admin/invoices/index.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Invoice') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Invoice</h3>
                    <a href="{{ route('invoices.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Buat Invoice Baru
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg shadow-md">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Nomor Invoice</th>
                                <th class="py-3 px-6 text-left">Pelanggan</th>
                                <th class="py-3 px-6 text-left">Tanggal Invoice</th>
                                <th class="py-3 px-6 text-left">Jatuh Tempo</th>
                                <th class="py-3 px-6 text-right">Total</th>
                                <th class="py-3 px-6 text-center">Status</th>
                                <th class="py-3 px-6 text-left">Dibuat Oleh</th>
                                <th class="py-3 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @forelse ($invoices as $invoice)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">{{ $invoice->invoice_number }}
                                    </td>
                                    <td class="py-3 px-6 text-left">{{ $invoice->customer->name ?? 'N/A' }}</td>
                                    <td class="py-3 px-6 text-left">{{ $invoice->invoice_date->format('d M Y') }}</td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $invoice->due_date ? $invoice->due_date->format('d M Y') : '-' }}</td>
                                    <td class="py-3 px-6 text-right whitespace-nowrap">Rp
                                        {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
                                    <td class="py-3 px-6 text-center">
                                        <span
                                            class="px-2 py-1 rounded-full text-xs font-semibold
                                            @if ($invoice->payment_status == 'paid') bg-green-200 text-green-800
                                            @elseif ($invoice->payment_status == 'pending') bg-yellow-200 text-yellow-800
                                            @else bg-red-200 text-red-800 @endif">
                                            {{ ucfirst($invoice->payment_status) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-left">{{ $invoice->user->name ?? 'N/A' }}</td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center space-x-2">
                                            <a href="{{ route('invoices.show', $invoice->id) }}"
                                                class="w-4 h-4 text-blue-500 hover:text-blue-700 transform hover:scale-110"
                                                title="Lihat">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('invoices.edit', $invoice->id) }}"
                                                class="w-4 h-4 text-purple-500 hover:text-purple-700 transform hover:scale-110"
                                                title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus invoice ini?');"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-4 h-4 text-red-500 hover:text-red-700 transform hover:scale-110"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-3 px-6 text-center text-gray-500">Tidak ada invoice
                                        yang tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $invoices->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
