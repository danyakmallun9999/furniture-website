{{-- resources/views/admin/invoices/edit.blade.php --}}

<x-app-layout> {{-- START x-app-layout --}}
    <x-slot name="header"> {{-- START x-slot header --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Invoice') }} - {{ $invoice->invoice_number }}
        </h2>
    </x-slot> {{-- END x-slot header --}}

    {{-- Konten utama form berada di sini --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 border border-gray-200">

                {{-- Flash Messages --}}
                @if (session('success'))
                    {{-- START Blade If --}}
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif {{-- END Blade If --}}
                @if ($errors->any()) {{-- START Blade If --}}
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                {{-- START Blade Foreach --}}
                                <li>{{ $error }}</li>
                            @endforeach {{-- END Blade Foreach --}}
                        </ul>
                    </div>
                @endif {{-- END Blade If --}}

                <form action="{{ route('invoices.update', $invoice->id) }}" method="POST" x-data="invoiceForm(
                    JSON.parse('{{ $invoice->toJson() }}'),
                    JSON.parse('{{ $invoice->items->toJson() }}'),
                    '{{ old('customer_input_method', $invoice->customer_id ? 'existing' : 'new') }}'
                    {{-- Lewatkan customerInputMethod --}}
                )">
                    @csrf
                    @method('PUT') {{-- Penting untuk operasi update --}}

                    {{-- Bagian Detail Invoice --}}
                    <div class="mb-8 p-6 bg-gray-50 rounded-lg border border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Detail Invoice</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Customer input method - x-data dipindahkan ke fungsi JS --}}
                            <div>
                                <label class="block font-medium text-sm text-gray-700 mb-2">Pilih Pelanggan</label>
                                <div class="flex items-center space-x-4 mb-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" x-model="customerInputMethod" value="existing"
                                            name="customer_input_method" class="form-radio text-indigo-600"
                                            @change="if(customerInputMethod === 'existing') { $refs.newCustomerName.value = ''; }">
                                        <span class="ml-2 text-sm text-gray-700">Pelanggan Terdaftar</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" x-model="customerInputMethod" value="new"
                                            name="customer_input_method" class="form-radio text-indigo-600"
                                            @change="if(customerInputMethod === 'new') { $refs.existingCustomerId.value = ''; }">
                                        <span class="ml-2 text-sm text-gray-700">Pelanggan Baru (Manual)</span>
                                    </label>
                                </div>

                                {{-- Input untuk Pelanggan Terdaftar --}}
                                <div x-show="customerInputMethod === 'existing'"> {{-- START Alpine x-show --}}
                                    <label for="customer_id" class="sr-only">Pelanggan Terdaftar</label>
                                    <select id="customer_id" name="customer_id" x-ref="existingCustomerId"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        x-bind:required="customerInputMethod === 'existing'">
                                        <option value="">Pilih Pelanggan</option>
                                        @foreach ($customers as $customer)
                                            {{-- START Blade Foreach --}}
                                            <option value="{{ $customer->id }}"
                                                {{ old('customer_id', $invoice->customer_id) == $customer->id ? 'selected' : '' }}>
                                                {{ $customer->name }} ({{ $customer->email ?? $customer->phone }})
                                            </option>
                                        @endforeach {{-- END Blade Foreach --}}
                                    </select>
                                    @error('customer_id')
                                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                    @enderror
                                </div> {{-- END Alpine x-show --}}

                                {{-- Input untuk Pelanggan Baru --}}
                                <div x-show="customerInputMethod === 'new'"> {{-- START Alpine x-show --}}
                                    <label for="new_customer_name" class="sr-only">Nama Pelanggan Baru</label>
                                    <input type="text" id="new_customer_name" name="new_customer_name"
                                        x-ref="newCustomerName"
                                        value="{{ old('new_customer_name', $invoice->customer->name ?? '') }}"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        placeholder="Nama Pelanggan Baru"
                                        x-bind:required="customerInputMethod === 'new'">
                                    @error('new_customer_name')
                                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                    @enderror
                                </div> {{-- END Alpine x-show --}}
                            </div> {{-- END of customer selection div --}}
                            <div>
                                <label for="invoice_number" class="block font-medium text-sm text-gray-700">Nomor
                                    Invoice</label>
                                <input type="text" id="invoice_number" name="invoice_number"
                                    value="{{ old('invoice_number', $invoice->invoice_number) }}"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required>
                                @error('invoice_number')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="invoice_date" class="block font-medium text-sm text-gray-700">Tanggal
                                    Invoice</label>
                                <input type="date" id="invoice_date" name="invoice_date"
                                    value="{{ old('invoice_date', $invoice->invoice_date->format('Y-m-d')) }}"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required>
                                @error('invoice_date')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="due_date" class="block font-medium text-sm text-gray-700">Tanggal Jatuh
                                    Tempo (Opsional)</label>
                                <input type="date" id="due_date" name="due_date"
                                    value="{{ old('due_date', $invoice->due_date ? $invoice->due_date->format('Y-m-d') : '') }}"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @error('due_date')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="notes" class="block font-medium text-sm text-gray-700">Catatan
                                (Opsional)</label>
                            <textarea id="notes" name="notes"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('notes', $invoice->notes) }}</textarea>
                            @error('notes')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Bagian Item Invoice (Dinamis) --}}
                    <div class="mb-8 p-6 bg-gray-50 rounded-lg border border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Item Invoice</h3>
                        <div id="invoice-items-container">
                            <template x-for="(item, index) in items" :key="item.id"> {{-- START Alpine x-for --}}
                                <div
                                    class="grid grid-cols-1 md:grid-cols-6 gap-4 items-end mb-4 p-4 border border-gray-200 rounded-lg bg-white shadow-sm">
                                    <input type="hidden" :name="'items[' + index + '][item_id]'"
                                        :value="item.id">
                                    <input type="hidden" :name="'items[' + index + '][product_id]'"
                                        :value="item.product_id">
                                    <input type="hidden" :name="'items[' + index + '][product_name_at_sale]'"
                                        :value="item.product_name_at_sale">
                                    <input type="hidden" :name="'items[' + index + '][product_motif_at_sale]'"
                                        :value="item.product_motif_at_sale">
                                    <input type="hidden" :name="'items[' + index + '][total_item_price]'"
                                        :value="item.total_item_price">

                                    <div class="md:col-span-2">
                                        <label class="block font-medium text-sm text-gray-700">Produk</label>
                                        <select :name="'items[' + index + '][product_id_select]'"
                                            @change="updateItemProduct(index, $event.target.value)"
                                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required>
                                            <option value="">Pilih Produk</option>
                                            @foreach ($products as $product)
                                                {{-- START Blade Foreach --}}
                                                <option value="{{ $product->id }}"
                                                    :selected="item.product_id == {{ $product->id }}">
                                                    {{ $product->name }}
                                                    (Rp{{ number_format($product->price ?? 0, 0, ',', '.') }})
                                                </option>
                                            @endforeach {{-- END Blade Foreach --}}
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700">Harga Satuan</label>
                                        <input type="number" :name="'items[' + index + '][unit_price]'"
                                            x-model.number="item.unit_price" @input="calculateTotal()"
                                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required step="0.01">
                                    </div>
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700">Kuantitas</label>
                                        <input type="number" :name="'items[' + index + '][quantity]'"
                                            x-model.number="item.quantity" @input="calculateTotal()"
                                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required min="1">
                                    </div>
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700">Subtotal</label>
                                        <input type="text" x-model="formatCurrency(item.total_item_price)"
                                            class="mt-1 block w-full border-gray-300 bg-gray-100 rounded-md shadow-sm"
                                            readonly>
                                    </div>
                                    <div class="flex justify-end md:col-span-1">
                                        <button type="button" @click="removeItem(index)"
                                            class="inline-flex items-center px-3 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">Hapus</button>
                                    </div>
                                </div>
                            </template> {{-- END Alpine x-for --}}
                        </div>
                        <button type="button" @click="addItem()"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mt-4">
                            Tambah Item
                        </button>
                    </div>

                    {{-- Bagian Total & Status Pembayaran --}}
                    <div class="mt-8 p-6 bg-gray-50 rounded-lg border border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-1">
                                <label for="payment_status" class="block font-medium text-sm text-gray-700">Status
                                    Pembayaran</label>
                                <select id="payment_status" name="payment_status"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required>
                                    <option value="pending"
                                        {{ old('payment_status', $invoice->payment_status) == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="paid"
                                        {{ old('payment_status', $invoice->payment_status) == 'paid' ? 'selected' : '' }}>
                                        Paid</option>
                                    <option value="canceled"
                                        {{ old('payment_status', $invoice->payment_status) == 'canceled' ? 'selected' : '' }}>
                                        Canceled</option>
                                </select>
                                @error('payment_status')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="md:col-span-1 text-right">
                                <label class="block font-medium text-sm text-gray-700">Total Invoice</label>
                                <p class="text-3xl font-bold text-indigo-600 mt-1">Rp <span
                                        x-text="formatCurrency(totalAmount)">0</span></p>
                                <input type="hidden" name="total_amount" x-model.number="totalAmount">
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Simpan --}}
                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('invoices.index') }}"
                            class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Perbarui Invoice') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const allProducts = @json($products->keyBy('id'));

            function invoiceForm(invoiceData = {}, invoiceItems = []) {
                return {
                    items: [],
                    totalAmount: 0,
                    nextItemId: 1,
                    // customerInputMethod diinisialisasi di HTML menggunakan x-data di div terluar dari bagian pelanggan
                    customerInputMethod: '{{ old('customer_input_method', $invoice->customer_id ? 'existing' : 'new') }}', // <<-- Inisialisasi di sini

                    init() {
                        // Logika inisialisasi customerInputMethod
                        const oldNewCustomerName = "{{ old('new_customer_name', '') }}";
                        if (oldNewCustomerName) { // START JS If (untuk old input)
                            this.customerInputMethod = 'new';
                            this.$nextTick(() => {
                                if (this.$refs.newCustomerName) {
                                    this.$refs.newCustomerName.value = oldNewCustomerName;
                                }
                            });
                        }
                        // Tambahkan ini agar customerInputMethod diinisialisasi.
                        // Ini adalah $watch yang dipasang pada properti customerInputMethod di root Alpine.js
                        // untuk mengosongkan field yang tidak relevan.
                        this.$watch('customerInputMethod', (value) => {
                            if (value === 'existing' && this.$refs.newCustomerName) {
                                this.$refs.newCustomerName.value = '';
                            } else if (value === 'new' && this.$refs.existingCustomerId) {
                                this.$refs.existingCustomerId.value = '';
                            }
                        });

                        // Inisialisasi item invoice
                        if (invoiceItems && invoiceItems.length > 0) { // START JS If (untuk invoiceItems)
                            this.items = invoiceItems.map(item => ({
                                id: item.id,
                                product_id: item.product_id,
                                product_name_at_sale: item.product_name_at_sale,
                                product_motif_at_sale: item.product_motif_at_sale,
                                unit_price: parseFloat(item.unit_price),
                                quantity: parseInt(item.quantity),
                                total_item_price: parseFloat(item.total_item_price)
                            }));
                            this.nextItemId = Math.max(...invoiceItems.map(item => item.id || 0)) + 1;
                        } else { // START JS Else
                            // Jika tidak ada item dari database (misal: invoice lama tanpa item)
                            this.addItem(); // Tambah satu baris item kosong sebagai default
                        } // END JS Else
                        this.calculateTotal(); // Hitung total awal
                        this.$watch('items', () => this.calculateTotal()); // Watch items array for changes
                    }, // END init()

                    addItem() {
                        this.items.push({
                            id: 'new-' + this.nextItemId++,
                            product_id: '',
                            product_name_at_sale: '',
                            product_motif_at_sale: '',
                            unit_price: 0,
                            quantity: 1,
                            total_item_price: 0
                        });
                    },

                    removeItem(index) {
                        this.items.splice(index, 1);
                    },

                    updateItemProduct(index, productId) {
                        const product = allProducts[productId];
                        if (product) {
                            this.items[index].product_id = productId;
                            this.items[index].product_name_at_sale = product.name;
                            this.items[index].product_motif_at_sale = product.motif;
                            this.items[index].unit_price = product.price || 0;
                        } else {
                            this.items[index].product_id = '';
                            this.items[index].product_name_at_sale = '';
                            this.items[index].product_motif_at_sale = '';
                            this.items[index].unit_price = 0;
                        }
                        this.calculateTotal();
                    },

                    calculateTotal() {
                        let grandTotal = 0;
                        this.items.forEach(item => {
                            const itemTotal = parseFloat(item.unit_price || 0) * parseInt(item.quantity || 0);
                            item.total_item_price = itemTotal;
                            grandTotal += itemTotal;
                        });
                        this.totalAmount = grandTotal;
                    },

                    formatCurrency(value) {
                        return parseFloat(value).toLocaleString('id-ID', {
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0
                        });
                    }
                } // END return
            } // END function invoiceForm
        </script>
    @endpush {{-- END push scripts --}}
</x-app-layout> {{-- END x-app-layout --}}
