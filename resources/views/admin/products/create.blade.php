{{-- resources/views/admin/products/create.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Produk Mebel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    {{-- Penting: enctype untuk upload file --}}
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="category_id" :value="__('Kategori Produk')" />
                        <select id="category_id" name="category_id"
                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Nama Produk')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Kolom-kolom baru dimulai di sini --}}
                    <div class="mb-4">
                        <x-input-label for="product_type" :value="__('Jenis Produk (Opsional)')" />
                        <x-text-input id="product_type" class="block mt-1 w-full" type="text" name="product_type"
                            :value="old('product_type')" placeholder="misal: Gebyok Ukiran Jepara" />
                        <x-input-error :messages="$errors->get('product_type')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="motif" :value="__('Motif (Opsional)')" />
                        <x-text-input id="motif" class="block mt-1 w-full" type="text" name="motif"
                            :value="old('motif')" placeholder="misal: Ukiran Klasik Jawa - Flora dan Sulur" />
                        <x-input-error :messages="$errors->get('motif')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="price" :value="__('Harga (Opsional, tanpa titik/koma)')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" name="price"
                            :value="old('price')" placeholder="misal: 30000000 untuk Rp30.000.000" min="0" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="short_description" :value="__('Deskripsi Singkat (Opsional)')" />
                        <x-textarea id="short_description" class="block mt-1 w-full"
                            name="short_description">{{ old('short_description') }}</x-textarea>
                        <x-input-error :messages="$errors->get('short_description')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <label for="is_customizable" class="flex items-center">
                            <input type="checkbox" id="is_customizable" name="is_customizable" value="1"
                                {{ old('is_customizable') ? 'checked' : '' }}
                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Produk dapat dikustomisasi (harga bisa berubah)') }}</span>
                        </label>
                        <x-input-error :messages="$errors->get('is_customizable')" class="mt-2" />
                    </div>
                    {{-- Kolom-kolom baru berakhir di sini --}}

                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Deskripsi Lengkap (Opsional)')" />
                        <x-textarea id="description" class="block mt-1 w-full"
                            name="description">{{ old('description') }}</x-textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="mb-4">
                            <x-input-label for="wood_type" :value="__('Jenis Kayu (Opsional)')" />
                            <x-text-input id="wood_type" class="block mt-1 w-full" type="text" name="wood_type"
                                :value="old('wood_type')" />
                            <x-input-error :messages="$errors->get('wood_type')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="dimensions" :value="__('Dimensi (Opsional)')" />
                            <x-text-input id="dimensions" class="block mt-1 w-full" type="text" name="dimensions"
                                :value="old('dimensions')" placeholder="misal: P120 x L80 x T75 cm" />
                            <x-input-error :messages="$errors->get('dimensions')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="finishing" :value="__('Finishing (Opsional)')" />
                            <x-text-input id="finishing" class="block mt-1 w-full" type="text" name="finishing"
                                :value="old('finishing')" />
                            <x-input-error :messages="$errors->get('finishing')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="main_image" :value="__('Gambar Utama Produk')" />
                        <input type="file" id="main_image" name="main_image"
                            class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100 dark:file:bg-blue-700 dark:file:text-white dark:hover:file:bg-blue-600"
                            required />
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Format: JPG, PNG, GIF, SVG (Max 2MB)
                        </p>
                        <x-input-error :messages="$errors->get('main_image')" class="mt-2" />
                    </div>

                    {{-- Input untuk multiple images --}}
                    <div class="mb-4">
                        <x-input-label for="additional_images" :value="__('Gambar Tambahan Produk (Opsional, bisa pilih banyak)')" />
                        <input type="file" id="additional_images" name="additional_images[]" multiple
                            class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100 dark:file:bg-blue-700 dark:file:text-white dark:hover:file:bg-blue-600" />
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Format: JPG, PNG, GIF, SVG (Max 2MB per gambar)
                        </p>
                        <x-input-error :messages="$errors->get('additional_images')" class="mt-2" />
                        <x-input-error :messages="$errors->get('additional_images.*')" class="mt-2" /> {{-- Untuk error tiap file --}}
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('products.index') }}"
                            class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mr-4">Batal</a>
                        <x-primary-button>
                            {{ __('Simpan Produk') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>