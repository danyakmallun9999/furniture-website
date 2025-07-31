{{-- resources/views/admin/products/index.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center space-x-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white leading-tight">
                        Manajemen Produk Mebel
                    </h2>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                        Kelola semua produk mebel dan katalog
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
                                <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl flex items-center justify-center">
                                    <i data-lucide="package" class="w-5 h-5 text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Daftar Produk</h3>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">Kelola semua produk mebel</p>
                                </div>
                            </div>
                            <a href="{{ route('products.create') }}"
                                class="group flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                <i data-lucide="plus-circle" class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform"></i>
                                Tambah Produk
                            </a>
                        </div>
                    </div>

                    {{-- Table Section --}}
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-slate-200 dark:border-slate-700">
                                        <th class="text-left py-4 px-6 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="image" class="w-4 h-4"></i>
                                                <span>Gambar</span>
                                            </div>
                                        </th>
                                        <th class="text-left py-4 px-6 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="package" class="w-4 h-4"></i>
                                                <span>Nama Produk</span>
                                            </div>
                                        </th>
                                        <th class="text-left py-4 px-6 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="folder" class="w-4 h-4"></i>
                                                <span>Kategori</span>
                                            </div>
                                        </th>
                                        <th class="text-left py-4 px-6 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="tree" class="w-4 h-4"></i>
                                                <span>Jenis Kayu</span>
                                            </div>
                                        </th>
                                        <th class="text-left py-4 px-6 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="ruler" class="w-4 h-4"></i>
                                                <span>Dimensi</span>
                                            </div>
                                        </th>
                                        <th class="text-right py-4 px-6 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center justify-end space-x-2">
                                                <i data-lucide="dollar-sign" class="w-4 h-4"></i>
                                                <span>Harga</span>
                                            </div>
                                        </th>
                                        <th class="text-center py-4 px-6 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center justify-center space-x-2">
                                                <i data-lucide="settings" class="w-4 h-4"></i>
                                                <span>Custom</span>
                                            </div>
                                        </th>
                                        <th class="text-center py-4 px-6 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center justify-center space-x-2">
                                                <i data-lucide="more-horizontal" class="w-4 h-4"></i>
                                                <span>Aksi</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                    @forelse ($products as $product)
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors duration-200">
                                            <td class="py-4 px-6">
                                                @if ($product->main_image_path)
                                                    <div class="w-16 h-16 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-600">
                                                        <img src="{{ Storage::url($product->main_image_path) }}"
                                                            alt="{{ $product->name }}" 
                                                            class="w-full h-full object-cover">
                                                    </div>
                                                @else
                                                    <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-xl flex items-center justify-center border border-slate-200 dark:border-slate-600">
                                                        <i data-lucide="image" class="w-6 h-6 text-slate-400"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="py-4 px-6">
                                                <span class="font-medium text-slate-900 dark:text-white">{{ $product->name }}</span>
                                            </td>
                                            <td class="py-4 px-6">
                                                <span class="text-slate-600 dark:text-slate-400">{{ $product->category->name ?? 'N/A' }}</span>
                                            </td>
                                            <td class="py-4 px-6">
                                                <span class="text-slate-600 dark:text-slate-400">{{ $product->wood_type ?? '-' }}</span>
                                            </td>
                                            <td class="py-4 px-6">
                                                <span class="text-slate-600 dark:text-slate-400">{{ $product->dimensions ?? '-' }}</span>
                                            </td>
                                            <td class="py-4 px-6 text-right">
                                                @if ($product->price)
                                                    <span class="font-semibold text-slate-900 dark:text-white">
                                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                                    </span>
                                                @else
                                                    <span class="text-slate-500 dark:text-slate-400">Harga Custom</span>
                                                @endif
                                            </td>
                                            <td class="py-4 px-6 text-center">
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                                    {{ $product->is_customizable 
                                                        ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/20 dark:text-emerald-300' 
                                                        : 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300' }}">
                                                    {{ $product->is_customizable ? 'Ya' : 'Tidak' }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-6">
                                                <div class="flex items-center justify-center space-x-2">
                                                    <a href="{{ route('products.edit', $product->id) }}"
                                                        class="group p-2 rounded-xl bg-purple-50 dark:bg-purple-900/20 hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-all duration-200 transform hover:scale-110"
                                                        title="Edit">
                                                        <i data-lucide="edit-3" class="w-4 h-4 text-purple-600 dark:text-purple-400 group-hover:text-purple-700 dark:group-hover:text-purple-300"></i>
                                                    </a>
                                                    <form action="{{ route('products.destroy', $product->id) }}" 
                                                          method="POST"
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');"
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
                                            <td colspan="8" class="py-12 px-6 text-center">
                                                <div class="flex flex-col items-center space-y-4">
                                                    <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center">
                                                        <i data-lucide="package-x" class="w-8 h-8 text-slate-400"></i>
                                                    </div>
                                                    <div>
                                                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Tidak ada produk</h3>
                                                        <p class="text-slate-600 dark:text-slate-400">Mulai dengan menambahkan produk pertama Anda</p>
                                                    </div>
                                                    <a href="{{ route('products.create') }}"
                                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-medium rounded-lg transition-all duration-200">
                                                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                                                        Tambah Produk Pertama
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if($products->hasPages())
                            <div class="mt-6 pt-6 border-t border-slate-200 dark:border-slate-700">
                                {{ $products->links() }}
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