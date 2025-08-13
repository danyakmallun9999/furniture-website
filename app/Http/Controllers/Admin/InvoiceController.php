<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Product;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Penting: Sudah ada
use Illuminate\Support\Facades\DB; // <--- TAMBAHKAN BARIS INI
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule; // Penting: Sudah ada
use Illuminate\Support\Str; // Untuk Str::upper(Str::random(4)) di create view, meskipun tidak dipakai di controller ini, ada baiknya ada.
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource (Daftar Invoice).
     */
    public function index(Request $request)
    {
        $type = $request->input('type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $search = $request->input('search');

        $invoices = Invoice::with(['customer', 'user'])
                            ->latest()
                            ->when($type, function ($query, $type) {
                                return $query->where('type', $type);
                            })
                            ->when($startDate, function ($query, $startDate) {
                                return $query->whereDate('invoice_date', '>=', $startDate);
                            })
                            ->when($endDate, function ($query, $endDate) {
                                return $query->whereDate('invoice_date', '<=', $endDate);
                            })
                            ->when($search, function ($query, $search) {
                                return $query->where(function ($q) use ($search) {
                                    $q->where('invoice_number', 'like', '%' . $search . '%')
                                      ->orWhere('total_amount', 'like', '%' . $search . '%')
                                      ->orWhereHas('customer', function ($qc) use ($search) {
                                          $qc->where('name', 'like', '%' . $search . '%');
                                      });
                                });
                            })
                            ->paginate(10);

        return view('admin.invoices.index', compact('invoices', 'type', 'startDate', 'endDate', 'search'));
    }

    /**
     * Show the form for creating a new resource (Form Tambah Invoice).
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('admin.invoices.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_input_method' => 'required|in:existing,new',
            'customer_id' => Rule::requiredIf($request->input('customer_input_method') === 'existing') . '|nullable|exists:customers,id',
            'new_customer_name' => Rule::requiredIf($request->input('customer_input_method') === 'new') . '|nullable|string|max:255',
            'invoice_number' => 'required|string|max:255|unique:invoices',
            'invoice_date' => 'required|date',
            'due_date' => 'nullable|date|after_or_equal:invoice_date',
            'type' => 'required|in:kredit,debit',
            'total_amount' => 'required|numeric|min:0',
            'payment_status' => 'required|in:pending,paid,canceled',
            'notes' => 'nullable|string',
            'receipt_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'nullable|exists:products,id',
            'items.*.product_name_at_sale' => 'required|string|max:255',
            'items.*.product_motif_at_sale' => 'nullable|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.total_item_price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $customerId = null;

            if ($validatedData['customer_input_method'] === 'existing') {
                $customerId = $validatedData['customer_id'];
            } elseif ($validatedData['customer_input_method'] === 'new') {
                $newCustomer = Customer::create([
                    'name' => $validatedData['new_customer_name'],
                    // Anda bisa menambahkan field lain seperti email/phone jika ada di form
                ]);
                $customerId = $newCustomer->id;
            }

            $receiptImagePath = null;
            if ($request->hasFile('receipt_image')) {
                $receiptImagePath = $request->file('receipt_image')->store('receipts', 'public');
            }

            $invoice = Invoice::create([
                'customer_id' => $customerId,
                'user_id' => Auth::id(),
                'invoice_number' => $validatedData['invoice_number'],
                'invoice_date' => $validatedData['invoice_date'],
                'due_date' => $validatedData['due_date'],
                'type' => $validatedData['type'],
                'total_amount' => $validatedData['total_amount'],
                'payment_status' => $validatedData['payment_status'],
                'notes' => $validatedData['notes'],
                'receipt_image_path' => $receiptImagePath,
            ]);

            foreach ($validatedData['items'] as $itemData) {
                $invoice->items()->create([
                    'product_id' => $itemData['product_id'],
                    'product_name_at_sale' => $itemData['product_name_at_sale'],
                    'product_motif_at_sale' => $itemData['product_motif_at_sale'],
                    'quantity' => $itemData['quantity'],
                    'unit_price' => $itemData['unit_price'],
                    'total_item_price' => $itemData['total_item_price'],
                ]);
            }

            DB::commit();

            return redirect()->route('invoices.index')->with('success', 'Invoice ' . $invoice->invoice_number . ' berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();

            if ($e instanceof ValidationException) {
                throw $e;
            }

            return redirect()->back()->withInput()->with('error', 'Gagal membuat invoice: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource (Detail Invoice).
     */
    public function show(Invoice $invoice)
    {
        return view('admin.invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource (Form Edit Invoice).
     */
    public function edit(Invoice $invoice)
    {
        // Pastikan relasi items dimuat untuk form
        $invoice->load('items'); // Memuat item-item invoice

        $customers = Customer::all();
        $products = Product::all();
        return view('admin.invoices.edit', compact('invoice', 'customers', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Invoice $invoice)
    {
        // Validasi data utama invoice
        $validatedData = $request->validate([
            'customer_input_method' => 'required|in:existing,new',
            'customer_id' => Rule::requiredIf($request->input('customer_input_method') === 'existing') . '|nullable|exists:customers,id',
            'new_customer_name' => Rule::requiredIf($request->input('customer_input_method') === 'new') . '|nullable|string|max:255',
            'invoice_number' => ['required', 'string', 'max:255', Rule::unique('invoices')->ignore($invoice->id)], // Unique kecuali untuk invoice ini
            'invoice_date' => 'required|date',
            'due_date' => 'nullable|date|after_or_equal:invoice_date',
            'type' => 'required|in:kredit,debit',
            'total_amount' => 'required|numeric|min:0',
            'payment_status' => 'required|in:pending,paid,canceled',
            'notes' => 'nullable|string',
            'receipt_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'items' => 'required|array|min:1', // Harus ada setidaknya satu item
            'items.*.item_id' => 'nullable|integer', // ID item jika sudah ada
            'items.*.product_id' => 'nullable|exists:products,id',
            'items.*.product_name_at_sale' => 'required|string|max:255',
            'items.*.product_motif_at_sale' => 'nullable|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.total_item_price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $customerId = null;

            if ($validatedData['customer_input_method'] === 'existing') {
                $customerId = $validatedData['customer_id'];
            } elseif ($validatedData['customer_input_method'] === 'new') {
                $newCustomer = Customer::create([
                    'name' => $validatedData['new_customer_name'],
                    // Tambahkan field lain jika ada (email, phone, address)
                ]);
                $customerId = $newCustomer->id;
            }

            $dataToUpdate = [
                'customer_id' => $customerId,
                // 'user_id' tidak diubah karena ini adalah yang membuat invoice
                'invoice_number' => $validatedData['invoice_number'],
                'invoice_date' => $validatedData['invoice_date'],
                'due_date' => $validatedData['due_date'],
                'type' => $validatedData['type'],
                'total_amount' => $validatedData['total_amount'],
                'payment_status' => $validatedData['payment_status'],
                'notes' => $validatedData['notes'],
            ];

            if ($request->hasFile('receipt_image')) {
                // Hapus gambar lama jika ada
                if ($invoice->receipt_image_path) {
                    Storage::disk('public')->delete($invoice->receipt_image_path);
                }
                // Simpan yang baru
                $dataToUpdate['receipt_image_path'] = $request->file('receipt_image')->store('receipts', 'public');
            }

            // 1. Update Invoice Utama
            $invoice->update($dataToUpdate);

            // 2. Update Item Invoice (Sinkronisasi)
            $existingItemIds = $invoice->items->pluck('id')->toArray();
            $itemsToKeep = [];

            foreach ($validatedData['items'] as $itemData) {
                if (Str::startsWith($itemData['item_id'], 'new-')) {
                    // Item baru: buat record baru
                    $invoice->items()->create([
                        'product_id' => $itemData['product_id'],
                        'product_name_at_sale' => $itemData['product_name_at_sale'],
                        'product_motif_at_sale' => $itemData['product_motif_at_sale'],
                        'quantity' => $itemData['quantity'],
                        'unit_price' => $itemData['unit_price'],
                        'total_item_price' => $itemData['total_item_price'],
                    ]);
                } else {
                    // Item yang sudah ada: update record
                    $item = InvoiceItem::find($itemData['item_id']);
                    if ($item) {
                        $item->update([
                            'product_id' => $itemData['product_id'],
                            'product_name_at_sale' => $itemData['product_name_at_sale'],
                            'product_motif_at_sale' => $itemData['product_motif_at_sale'],
                            'quantity' => $itemData['quantity'],
                            'unit_price' => $itemData['unit_price'],
                            'total_item_price' => $itemData['total_item_price'],
                        ]);
                        $itemsToKeep[] = $item->id; // Tandai item ini untuk dipertahankan
                    }
                }
            }

            // Hapus item-item lama yang tidak lagi ada di form
            InvoiceItem::where('invoice_id', $invoice->id)
                        ->whereNotIn('id', $itemsToKeep)
                        ->delete();

            DB::commit();

            return redirect()->route('invoices.index')->with('success', 'Invoice ' . $invoice->invoice_number . ' berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();

            if ($e instanceof ValidationException) {
                throw $e;
            }

            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui invoice: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Invoice berhasil dihapus!');
    }

        /**
     * Download the specified invoice as PDF.
     */
    public function downloadPdf(Invoice $invoice)
    {
        // Memastikan relasi items, customer, dan user dimuat untuk view PDF
        $invoice->load(['items', 'customer', 'user']);

        // Render view ke HTML
        $html = view('admin.invoices.pdf', compact('invoice'))->render();

        // Buat PDF
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($html);

        // Opsional: Atur ukuran kertas dan orientasi
        // $pdf->setPaper('A4', 'portrait');

        // Unduh file PDF
        return $pdf->download('transaksi-' . $invoice->invoice_number . '.pdf');
    }
}