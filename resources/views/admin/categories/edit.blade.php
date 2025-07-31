{{-- resources/views/admin/categories/edit.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center space-x-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white leading-tight">
                        Edit Kategori Produk
                    </h2>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                        Perbarui informasi kategori yang ada
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Main Content Card --}}
            <div class="group relative">
                <div class="absolute inset-0 bg-slate-100 dark:bg-slate-800 rounded-2xl opacity-75 group-hover:opacity-100 blur-sm group-hover:blur-none transition-all duration-300"></div>
                <div class="relative bg-white dark:bg-slate-900 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 border border-slate-200 dark:border-slate-700">
                    {{-- Header Section --}}
                    <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-amber-500 to-orange-600 rounded-xl flex items-center justify-center">
                                <i data-lucide="edit-3" class="w-5 h-5 text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Edit Kategori</h3>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Perbarui informasi kategori "{{ $category->name }}"</p>
                            </div>
                        </div>
                    </div>

                    {{-- Form Section --}}
                    <div class="p-6">
                        <form action="{{ route('categories.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Nama Kategori Field --}}
                            <div class="mb-6">
                                <label for="name" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                    <div class="flex items-center space-x-2">
                                        <i data-lucide="tag" class="w-4 h-4 text-blue-500"></i>
                                        <span>Nama Kategori</span>
                                    </div>
                                </label>
                                <div class="relative">
                                    <input id="name" 
                                           type="text" 
                                           name="name"
                                           value="{{ old('name', $category->name) }}" 
                                           required 
                                           autofocus
                                           class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                           placeholder="Masukkan nama kategori">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i data-lucide="folder" class="w-4 h-4 text-slate-400"></i>
                                    </div>
                                </div>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Deskripsi Field --}}
                            <div class="mb-8">
                                <label for="description" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                    <div class="flex items-center space-x-2">
                                        <i data-lucide="file-text" class="w-4 h-4 text-blue-500"></i>
                                        <span>Deskripsi (Opsional)</span>
                                    </div>
                                </label>
                                <div class="relative">
                                    <textarea id="description" 
                                              name="description"
                                              rows="4"
                                              class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none"
                                              placeholder="Masukkan deskripsi kategori (opsional)">{{ old('description', $category->description) }}</textarea>
                                </div>
                                @error('description')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Action Buttons --}}
                            <div class="flex items-center justify-between pt-6 border-t border-slate-200 dark:border-slate-700">
                                <a href="{{ route('categories.index') }}"
                                   class="group flex items-center px-6 py-3 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white font-medium rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-all duration-200">
                                    <i data-lucide="arrow-left" class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform"></i>
                                    Kembali ke Daftar
                                </a>
                                <button type="submit"
                                        class="group flex items-center px-8 py-3 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                    <i data-lucide="save" class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform"></i>
                                    Perbarui Kategori
                                </button>
                            </div>
                        </form>
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

                // Add form validation feedback
                const inputs = document.querySelectorAll('input, textarea');
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
