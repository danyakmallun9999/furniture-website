<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel; // Impor Facade Excel
use App\Exports\InvoicesExport; // Export untuk invoices
use Illuminate\Validation\ValidationException; // Untuk menangkap error validasi impor
use App\Imports\InvoicesImport; // Import untuk invoices

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

        // Hitung total untuk summary
        $totalPemasukan = Invoice::when($type, fn($q, $t) => $q->where('type', $t))
            ->when($startDate, fn($q, $d) => $q->whereDate('invoice_date', '>=', $d))
            ->when($endDate, fn($q, $d) => $q->whereDate('invoice_date', '<=', $d))
            ->where('type', 'kredit')
            ->sum('total_amount');

        $totalPengeluaran = Invoice::when($type, fn($q, $t) => $q->where('type', $t))
            ->when($startDate, fn($q, $d) => $q->whereDate('invoice_date', '>=', $d))
            ->when($endDate, fn($q, $d) => $q->whereDate('invoice_date', '<=', $d))
            ->where('type', 'debit')
            ->sum('total_amount');

        $labaRugiBersih = $totalPemasukan - $totalPengeluaran;

        return view('admin.reports.financial', compact(
            'invoices', 'type', 'startDate', 'endDate', 'search',
            'totalPemasukan', 'totalPengeluaran', 'labaRugiBersih'
        ));
    }

    /**
     * Export invoices to Excel or PDF (format param: excel|pdf).
     */
    public function export(Request $request)
    {
        $format = $request->input('format', 'excel');
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

        if ($format === 'pdf') {
            $html = view('admin.reports.partials.financial_export_pdf', compact('invoices', 'type', 'startDate', 'endDate', 'search'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($html);
            return $pdf->download('laporan_transaksi.pdf');
        }

        return Excel::download(new InvoicesExport($invoices), 'laporan_transaksi.xlsx');
    }

    /**
     * Show form for import.
     */
    public function showImportForm()
    {
        return view('admin.reports.import');
    }

    /**
     * Import invoices from Excel.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:4096',
        ]);

        try {
            Excel::import(new InvoicesImport, $request->file('file'));
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

        return redirect()->route('reports.financial')->with('success', 'Data transaksi berhasil diimpor!');
    }
}
