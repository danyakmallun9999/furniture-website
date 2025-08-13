<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel; // Impor Facade Excel
use App\Exports\InvoicesExport; // Export untuk invoices
use Illuminate\Validation\ValidationException; // Untuk menangkap error validasi impor

class FinancialReportController extends Controller
{
    /**
     * Display the financial reports.
     */
    public function index(Request $request)
    {
        $type = $request->input('type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $search = $request->input('search');

        $invoices = Invoice::with(['user', 'customer'])
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
                      ->orWhere('notes', 'like', '%' . $search . '%')
                      ->orWhereHas('customer', function ($qc) use ($search) {
                          $qc->where('name', 'like', '%' . $search . '%');
                      });
                });
            })
            ->paginate(15);

        // Hitung total untuk summary cards di laporan
        $totalPemasukan = Invoice::when($type, function ($query, $type) {
                                    return $query->where('type', $type);
                                })
                                ->when($startDate, function ($query, $startDate) {
                                    return $query->whereDate('invoice_date', '>=', $startDate);
                                })
                                ->when($endDate, function ($query, $endDate) {
                                    return $query->whereDate('invoice_date', '<=', $endDate);
                                })
                                ->where('type', 'kredit')
                                ->sum('total_amount');

        $totalPengeluaran = Invoice::when($type, function ($query, $type) {
                                    return $query->where('type', $type);
                                })
                                ->when($startDate, function ($query, $startDate) {
                                    return $query->whereDate('invoice_date', '>=', $startDate);
                                })
                                ->when($endDate, function ($query, $endDate) {
                                    return $query->whereDate('invoice_date', '<=', $endDate);
                                })
                                ->where('type', 'debit')
                                ->sum('total_amount');

        $labaRugiBersih = $totalPemasukan - $totalPengeluaran;

        return view('admin.reports.financial', compact(
            'invoices', 'type', 'startDate', 'endDate', 'search',
            'totalPemasukan', 'totalPengeluaran', 'labaRugiBersih'
        ));
    }

    /**
     * Export invoices to Excel.
     */
    public function export(Request $request)
    {
        // Opsional: terapkan filter yang sama saat export
        $type = $request->input('type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $search = $request->input('search');

        $invoices = Invoice::with(['user', 'customer'])
            ->when($type, fn($q, $type) => $q->where('type', $type))
            ->when($startDate, fn($q, $startDate) => $q->whereDate('invoice_date', '>=', $startDate))
            ->when($endDate, fn($q, $endDate) => $q->whereDate('invoice_date', '<=', $endDate))
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('invoice_number', 'like', '%' . $search . '%')
                      ->orWhere('total_amount', 'like', '%' . $search . '%')
                      ->orWhere('notes', 'like', '%' . $search . '%')
                      ->orWhereHas('customer', function ($qc) use ($search) {
                          $qc->where('name', 'like', '%' . $search . '%');
                      });
                });
            })
            ->get();

        return Excel::download(new InvoicesExport($invoices), 'laporan_invoice.xlsx');
    }

    /**
     * Show form for import.
     */
    public function showImportForm()
    {
        return view('admin.reports.import'); // View untuk form import (tetap)
    }

    /**
     * Import transactions from Excel.
     */
    public function import(Request $request)
    {
        // Tetap: import transaksi jika masih dibutuhkan; dapat diubah ke invoice import di masa depan
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048', // Hanya boleh Excel/CSV, max 2MB
        ]);

        try {
            // Placeholder: tidak ada import invoice saat ini
            return redirect()->back()->with('error', 'Fitur impor untuk invoice belum tersedia.');
        } catch (ValidationException $e) {
            $failures = $e->failures();
            $errors = [];
            foreach ($failures as $failure) {
                $errors[] = 'Baris ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            }
            return redirect()->back()->withErrors($errors)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengimpor file: ' . $e->getMessage());
        }
    }
}
