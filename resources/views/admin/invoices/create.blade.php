{{-- resources/views/admin/invoices/create.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center space-x-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white leading-tight">
                        Buat Invoice Baru
                    </h2>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                        Buat invoice baru untuk pelanggan
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Flash Messages --}}
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

            @if ($errors->any())
                <div class="mb-6 group relative">
                    <div class="absolute inset-0 bg-red-100 dark:bg-red-900/20 rounded-2xl opacity-75 group-hover:opacity-100 blur-sm group-hover:blur-none transition-all duration-300"></div>
                    <div class="relative bg-white dark:bg-slate-900 rounded-2xl p-4 shadow-xl border border-red-200 dark:border-red-800">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-red-500 rounded-xl flex items-center justify-center">
                                <i data-lucide="alert-circle" class="w-4 h-4 text-white"></i>
                            </div>
                            <div>
                                <span class="text-red-700 dark:text-red-300 font-medium">Terjadi kesalahan:</span>
                                <ul class="list-disc list-inside mt-1 text-sm text-red-600 dark:text-red-400">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Main Form Card --}}
            <div class="group relative">
                <div class="absolute inset-0 bg-slate-100 dark:bg-slate-800 rounded-2xl opacity-75 group-hover:opacity-100 blur-sm group-hover:blur-none transition-all duration-300"></div>
                <div class="relative bg-white dark:bg-slate-900 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 border border-slate-200 dark:border-slate-700">
                    <form action="{{ route('invoices.store') }}" method="POST" x-data="invoiceForm()">
                        @csrf

                        {{-- Header Section --}}
                        <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-cyan-600 rounded-xl flex items-center justify-center">
                                    <i data-lucide="plus-circle" class="w-5 h-5 text-white"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Form Invoice Baru</h3>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">Isi informasi invoice di bawah ini</p>
                                </div>
                            </div>
                        </div>

                        {{-- Detail Invoice Section --}}
                        <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                            <h4 class="text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center">
                                <i data-lucide="file-text" class="w-5 h-5 mr-2 text-blue-500"></i>
                                Detail Invoice
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Customer Selection --}}
                                <div x-data="{ customerInputMethod: 'existing' }" class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">
                                        <div class="flex items-center space-x-2">
                                            <i data-lucide="user" class="w-4 h-4 text-blue-500"></i>
                                            <span>Pilih Pelanggan</span>
                                        </div>
                                    </label>
                                    <div class="flex items-center space-x-6 mb-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" x-model="customerInputMethod" value="existing"
                                                name="customer_input_method" class="form-radio text-blue-600"
                                                @change="if(customerInputMethod === 'existing') { $refs.newCustomerName.value = ''; }">
                                            <span class="ml-2 text-sm text-slate-700 dark:text-slate-300">Pelanggan Terdaftar</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" x-model="customerInputMethod" value="new"
                                                name="customer_input_method" class="form-radio text-blue-600"
                                                @change="if(customerInputMethod === 'new') { $refs.existingCustomerId.value = ''; }">
                                            <span class="ml-2 text-sm text-slate-700 dark:text-slate-300">Pelanggan Baru (Manual)</span>
                                        </label>
                                    </div>

                                    {{-- Existing Customer Selection --}}
                                    <div x-show="customerInputMethod === 'existing'">
                                        <select id="customer_id" name="customer_id" x-ref="existingCustomerId"
                                            class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                            x-bind:required="customerInputMethod === 'existing'">
                                            <option value="">Pilih Pelanggan</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}"
                                                    {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                                    {{ $customer->name }} ({{ $customer->email ?? $customer->phone }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('customer_id')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    {{-- New Customer Input --}}
                                    <div x-show="customerInputMethod === 'new'">
                                        <input type="text" id="new_customer_name" name="new_customer_name"
                                            x-ref="newCustomerName" value="{{ old('new_customer_name') }}"
                                            class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                            placeholder="Nama Pelanggan Baru"
                                            x-bind:required="customerInputMethod === 'new'">
                                        @error('new_customer_name')
                                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Invoice Number --}}
                                <div>
                                    <label for="invoice_number" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                        <div class="flex items-center space-x-2">
                                            <i data-lucide="hash" class="w-4 h-4 text-blue-500"></i>
                                            <span>Nomor Invoice</span>
                                        </div>
                                    </label>
                                    <input type="text" id="invoice_number" name="invoice_number"
                                        value="{{ old('invoice_number', 'INV-' . date('Ymd') . '-' . Str::upper(Str::random(4))) }}"
                                        class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                        required>
                                    @error('invoice_number')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- Invoice Date --}}
                                <div>
                                    <label for="invoice_date" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                        <div class="flex items-center space-x-2">
                                            <i data-lucide="calendar" class="w-4 h-4 text-blue-500"></i>
                                            <span>Tanggal Invoice</span>
                                        </div>
                                    </label>
                                    <input type="date" id="invoice_date" name="invoice_date"
                                        value="{{ old('invoice_date', date('Y-m-d')) }}"
                                        class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                        required>
                                    @error('invoice_date')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- Due Date --}}
                                <div>
                                    <label for="due_date" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                        <div class="flex items-center space-x-2">
                                            <i data-lucide="clock" class="w-4 h-4 text-blue-500"></i>
                                            <span>Tanggal Jatuh Tempo (Opsional)</span>
                                        </div>
                                    </label>
                                    <input type="date" id="due_date" name="due_date" value="{{ old('due_date') }}"
                                        class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                    @error('due_date')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- Payment Status --}}
                                <div>
                                    <label for="payment_status" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                        <div class="flex items-center space-x-2">
                                            <i data-lucide="activity" class="w-4 h-4 text-blue-500"></i>
                                            <span>Status Pembayaran</span>
                                        </div>
                                    </label>
                                    <select id="payment_status" name="payment_status"
                                        class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                        required>
                                        <option value="pending" {{ old('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="paid" {{ old('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="canceled" {{ old('payment_status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                    </select>
                                    @error('payment_status')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Notes --}}
                            <div class="mt-6">
                                <label for="notes" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                    <div class="flex items-center space-x-2">
                                        <i data-lucide="file-text" class="w-4 h-4 text-blue-500"></i>
                                        <span>Catatan (Opsional)</span>
                                    </div>
                                </label>
                                <textarea id="notes" name="notes" rows="3"
                                    class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none"
                                    placeholder="Tambahkan catatan untuk invoice ini">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        {{-- Invoice Items Section --}}
                        <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                            <div class="flex items-center justify-between mb-6">
                                <h4 class="text-lg font-semibold text-slate-900 dark:text-white flex items-center">
                                    <i data-lucide="package" class="w-5 h-5 mr-2 text-blue-500"></i>
                                    Item Invoice
                                </h4>
                                <button type="button" @click="addItem()"
                                    class="group flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                    <i data-lucide="plus" class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform"></i>
                                    Tambah Item
                                </button>
                            </div>

                            <div id="invoice-items-container" class="space-y-4">
                                <template x-for="(item, index) in items" :key="item.id">
                                    <div class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-6 border border-slate-200 dark:border-slate-700">
                                        <div class="grid grid-cols-1 lg:grid-cols-6 gap-4 items-end">
                                            <input type="hidden" :name="'items[' + index + '][product_id]'" :value="item.product_id">
                                            <input type="hidden" :name="'items[' + index + '][product_name_at_sale]'" :value="item.product_name_at_sale">
                                            <input type="hidden" :name="'items[' + index + '][product_motif_at_sale]'" :value="item.product_motif_at_sale">
                                            <input type="hidden" :name="'items[' + index + '][total_item_price]'" :value="item.total_item_price">

                                            {{-- Product Selection --}}
                                            <div class="lg:col-span-2">
                                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                                    <div class="flex items-center space-x-2">
                                                        <i data-lucide="package" class="w-4 h-4 text-blue-500"></i>
                                                        <span>Produk</span>
                                                    </div>
                                                </label>
                                                <select :name="'items[' + index + '][product_id_select]'"
                                                    @change="updateItemProduct(index, $event.target.value)"
                                                    class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                                    required>
                                                    <option value="">Pilih Produk</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}" :selected="item.product_id == {{ $product->id }}">
                                                            {{ $product->name }} (Rp{{ number_format($product->price ?? 0, 0, ',', '.') }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            {{-- Unit Price --}}
                                            <div>
                                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                                    <div class="flex items-center space-x-2">
                                                        <i data-lucide="dollar-sign" class="w-4 h-4 text-blue-500"></i>
                                                        <span>Harga Satuan</span>
                                                    </div>
                                                </label>
                                                <input type="number" :name="'items[' + index + '][unit_price]'"
                                                    x-model.number="item.unit_price" @input="calculateTotal()"
                                                    class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                                    required step="0.01">
                                            </div>

                                            {{-- Quantity --}}
                                            <div>
                                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                                    <div class="flex items-center space-x-2">
                                                        <i data-lucide="hash" class="w-4 h-4 text-blue-500"></i>
                                                        <span>Kuantitas</span>
                                                    </div>
                                                </label>
                                                <input type="number" :name="'items[' + index + '][quantity]'"
                                                    x-model.number="item.quantity" @input="calculateTotal()"
                                                    class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                                    required min="1">
                                            </div>

                                            {{-- Subtotal --}}
                                            <div>
                                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                                    <div class="flex items-center space-x-2">
                                                        <i data-lucide="calculator" class="w-4 h-4 text-blue-500"></i>
                                                        <span>Subtotal</span>
                                                    </div>
                                                </label>
                                                <input type="text" x-model="formatCurrency(item.total_item_price)"
                                                    class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-900 dark:text-white"
                                                    readonly>
                                            </div>

                                            {{-- Remove Button --}}
                                            <div class="flex justify-end">
                                                <button type="button" @click="removeItem(index)"
                                                    class="group p-3 rounded-xl bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 transition-all duration-200 transform hover:scale-110">
                                                    <i data-lucide="trash-2" class="w-4 h-4 text-red-600 dark:text-red-400 group-hover:text-red-700 dark:group-hover:text-red-300"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        {{-- Total Section --}}
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-lg font-semibold text-slate-900 dark:text-white flex items-center">
                                        <i data-lucide="dollar-sign" class="w-5 h-5 mr-2 text-emerald-500"></i>
                                        Total Invoice
                                    </h4>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">Total keseluruhan invoice</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-3xl font-bold text-emerald-600 dark:text-emerald-400">
                                        Rp <span x-text="formatCurrency(totalAmount)">0</span>
                                    </div>
                                    <input type="hidden" name="total_amount" x-model.number="totalAmount">
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center justify-between p-6 border-t border-slate-200 dark:border-slate-700">
                            <a href="{{ route('invoices.index') }}"
                               class="group flex items-center px-6 py-3 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white font-medium rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-all duration-200">
                                <i data-lucide="arrow-left" class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform"></i>
                                Kembali ke Daftar
                            </a>
                            <button type="submit"
                                    class="group flex items-center px-8 py-3 bg-gradient-to-r from-emerald-500 to-cyan-600 hover:from-emerald-600 hover:to-cyan-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                <i data-lucide="save" class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform"></i>
                                Simpan Invoice
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const allProducts = @json($products->keyBy('id'));

            function invoiceForm() {
                return {
                    items: [],
                    totalAmount: 0,
                    nextItemId: 1,

                    init() {
                        this.addItem();
                        this.$watch('items', () => this.calculateTotal());
                    },

                    addItem() {
                        this.items.push({
                            id: this.nextItemId++,
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
                }
            }

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
