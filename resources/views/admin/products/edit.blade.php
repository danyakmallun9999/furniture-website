{{-- resources/views/admin/products/edit.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Produk Mebel') }} - {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-input-label for="category_id" :value="__('Kategori Produk')" />
                        <select id="category_id" name="category_id"
                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Nama Produk')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name', $product->name)" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="product_type" :value="__('Jenis Produk (Opsional)')" />
                        <x-text-input id="product_type" class="block mt-1 w-full" type="text" name="product_type"
                            :value="old('product_type', $product->product_type)" placeholder="misal: Gebyok Ukiran Jepara" />
                        <x-input-error :messages="$errors->get('product_type')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="motif" :value="__('Motif (Opsional)')" />
                        <x-text-input id="motif" class="block mt-1 w-full" type="text" name="motif"
                            :value="old('motif', $product->motif)" placeholder="misal: Ukiran Klasik Jawa - Flora dan Sulur" />
                        <x-input-error :messages="$errors->get('motif')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="price" :value="__('Harga (Opsional, tanpa titik/koma)')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" name="price"
                            :value="old('price', $product->price)" placeholder="misal: 30000000 untuk Rp30.000.000" min="0" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="short_description" :value="__('Deskripsi Singkat (Opsional)')" />
                        <x-textarea id="short_description" class="block mt-1 w-full"
                            name="short_description">{{ old('short_description', $product->short_description) }}</x-textarea>
                        <x-input-error :messages="$errors->get('short_description')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <label for="is_customizable" class="flex items-center">
                            <input type="checkbox" id="is_customizable" name="is_customizable" value="1"
                                {{ old('is_customizable', $product->is_customizable) ? 'checked' : '' }}
                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Produk dapat dikustomisasi (harga bisa berubah)') }}</span>
                        </label>
                        <x-input-error :messages="$errors->get('is_customizable')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Deskripsi Lengkap (Opsional)')" />
                        <x-textarea id="description" class="block mt-1 w-full"
                            name="description">{{ old('description', $product->description) }}</x-textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="mb-4">
                            <x-input-label for="wood_type" :value="__('Jenis Kayu (Opsional)')" />
                            <x-text-input id="wood_type" class="block mt-1 w-full" type="text" name="wood_type"
                                :value="old('wood_type', $product->wood_type)" />
                            <x-input-error :messages="$errors->get('wood_type')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="dimensions" :value="__('Dimensi (Opsional)')" />
                            <x-text-input id="dimensions" class="block mt-1 w-full" type="text" name="dimensions"
                                :value="old('dimensions', $product->dimensions)" placeholder="misal: P120 x L80 x T75 cm" />
                            <x-input-error :messages="$errors->get('dimensions')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="finishing" :value="__('Finishing (Opsional)')" />
                            <x-text-input id="finishing" class="block mt-1 w-full" type="text" name="finishing"
                                :value="old('finishing', $product->finishing)" />
                            <x-input-error :messages="$errors->get('finishing')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="main_image" :value="__('Gambar Utama Produk (Kosongkan jika tidak ingin diubah)')" />
                        <input type="file" id="main_image" name="main_image"
                            class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100 dark:file:bg-blue-700 dark:file:text-white dark:hover:file:bg-blue-600" />
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Format: JPG, PNG, GIF, SVG (Max 2MB)
                        </p>
                        <x-input-error :messages="$errors->get('main_image')" class="mt-2" />
                        @if ($product->main_image_path)
                            <div class="mt-2">
                                <p class="text-sm text-gray-600 dark:text-gray-400">Gambar saat ini:</p>
                                <img src="{{ Storage::url($product->main_image_path) }}" alt="{{ $product->name }}"
                                    class="w-24 h-24 object-cover rounded">
                            </div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <x-input-label for="additional_images" :value="__('Unggah Gambar Tambahan Baru (Opsional, bisa pilih banyak)')" />
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
                        <x-input-error :messages="$errors->get('additional_images.*')" class="mt-2" />
                    </div>

                    @if ($product->images->count() > 0)
                        <div class="mb-4">
                            <x-input-label :value="__('Gambar Tambahan Saat Ini')" />
                            <div id="existing-images-container" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mt-2">
                                @foreach ($product->images as $image)
                                    <div id="image-{{ $image->id }}" class="relative group
                                        @if(old('existing_images_to_delete') && in_array($image->id, old('existing_images_to_delete')))
                                            opacity-30 border-red-500
                                        @endif
                                    ">
                                        <img src="{{ Storage::url($image->image_path) }}" alt="Produk Gambar"
                                            class="w-full h-32 object-cover rounded border border-gray-300 dark:border-gray-600">
                                        <label
                                            class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center"
                                            title="Hapus gambar ini">
                                            <input type="checkbox" name="existing_images_to_delete[]" value="{{ $image->id }}"
                                                class="hidden peer image-delete-checkbox"
                                                data-image-id="{{ $image->id }}"
                                                {{ old('existing_images_to_delete') && in_array($image->id, old('existing_images_to_delete')) ? 'checked' : '' }}>
                                            <svg class="w-5 h-5 peer-checked:hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 012 0v6a1 1 0 11-2 0V8z" clip-rule="evenodd"></path>
                                            </svg>
                                            <svg class="w-5 h-5 hidden peer-checked:block text-red-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L10 8.586 7.707 6.293a1 1 0 00-1.414 1.414L8.586 10l-2.293 2.293a1 1 0 001.414 1.414L10 11.414l2.293 2.293a1 1 0 001.414-1.414L11.414 10l2.293-2.293z" clip-rule="evenodd"></path>
                                            </svg>
                                        </label>
                                        <p class="text-center text-xs text-gray-500 mt-1 image-delete-status" id="status-{{ $image->id }}">
                                            @if(old('existing_images_to_delete') && in_array($image->id, old('existing_images_to_delete')))
                                                <span class="text-red-500">Akan Dihapus</span>
                                            @endif
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('existing_images_to_delete')" class="mt-2" />
                        </div>
                    @endif

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('products.index') }}"
                            class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mr-4">Batal</a>
                        <x-primary-button>
                            {{ __('Perbarui Produk') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- Script JavaScript baru --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteCheckboxes = document.querySelectorAll('.image-delete-checkbox');

            deleteCheckboxes.forEach(checkbox => {
                const imageId = checkbox.dataset.imageId;
                const imageDiv = document.getElementById(`image-${imageId}`);
                const statusSpan = document.getElementById(`status-${imageId}`);

                function updateImageDisplay() {
                    if (checkbox.checked) {
                        imageDiv.classList.add('opacity-30', 'border-red-500');
                        imageDiv.classList.remove('border-gray-300', 'dark:border-gray-600');
                        statusSpan.innerHTML = '<span class="text-red-500">Akan Dihapus</span>';
                    } else {
                        imageDiv.classList.remove('opacity-30', 'border-red-500');
                        imageDiv.classList.add('border-gray-300', 'dark:border-gray-600');
                        statusSpan.innerHTML = '';
                    }
                }

                updateImageDisplay();
                checkbox.addEventListener('change', updateImageDisplay);
            });
        });
    </script>
</x-app-layout>