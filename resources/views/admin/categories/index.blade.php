{{-- resources/views/admin/categories/index.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center space-x-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white leading-tight">
                        Manajemen Kategori Produk
                    </h2>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                        Kelola kategori produk untuk organisasi yang lebih baik
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
                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                                    <i data-lucide="folder-tree" class="w-5 h-5 text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Daftar Kategori</h3>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">Kelola semua kategori produk</p>
                                </div>
                            </div>
                            <a href="{{ route('categories.create') }}"
                                class="group flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                <i data-lucide="plus-circle" class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform"></i>
                                Tambah Kategori
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
                                                <i data-lucide="tag" class="w-4 h-4"></i>
                                                <span>Nama Kategori</span>
                                            </div>
                                        </th>
                                        <th class="text-left py-4 px-6 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="file-text" class="w-4 h-4"></i>
                                                <span>Deskripsi</span>
                                            </div>
                                        </th>
                                        <th class="text-center py-4 px-6 font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                            <div class="flex items-center justify-center space-x-2">
                                                <i data-lucide="settings" class="w-4 h-4"></i>
                                                <span>Aksi</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                    @forelse ($categories as $category)
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors duration-200">
                                            <td class="py-4 px-6">
                                                <div class="flex items-center space-x-3">
                                                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                                        <i data-lucide="folder" class="w-4 h-4 text-white"></i>
                                                    </div>
                                                    <span class="font-medium text-slate-900 dark:text-white">{{ $category->name }}</span>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6">
                                                <span class="text-slate-600 dark:text-slate-400">
                                                    {{ $category->description ?? '-' }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-6">
                                                <div class="flex items-center justify-center space-x-2">
                                                    <a href="{{ route('categories.edit', $category->id) }}"
                                                        class="group p-2 rounded-xl bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-all duration-200 transform hover:scale-110">
                                                        <i data-lucide="edit-3" class="w-4 h-4 text-blue-600 dark:text-blue-400 group-hover:text-blue-700 dark:group-hover:text-blue-300"></i>
                                                    </a>
                                                    <form action="{{ route('categories.destroy', $category->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');"
                                                        class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="group p-2 rounded-xl bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 transition-all duration-200 transform hover:scale-110">
                                                            <i data-lucide="trash-2" class="w-4 h-4 text-red-600 dark:text-red-400 group-hover:text-red-700 dark:group-hover:text-red-300"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="py-12 px-6 text-center">
                                                <div class="flex flex-col items-center space-y-4">
                                                    <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center">
                                                        <i data-lucide="folder-x" class="w-8 h-8 text-slate-400"></i>
                                                    </div>
                                                    <div>
                                                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Tidak ada kategori</h3>
                                                        <p class="text-slate-600 dark:text-slate-400">Mulai dengan menambahkan kategori pertama Anda</p>
                                                    </div>
                                                    <a href="{{ route('categories.create') }}"
                                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-medium rounded-lg transition-all duration-200">
                                                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                                                        Tambah Kategori Pertama
                                                    </a>
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
