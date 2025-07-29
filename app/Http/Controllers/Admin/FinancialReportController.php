<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel; // Impor Facade Excel
use App\Exports\TransactionsExport; // Akan kita buat nanti
use App\Imports\TransactionsImport; // Akan kita buat nanti
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

        $transactions = Transaction::with('user') // Ambil user yang mencatat transaksi
            ->latest()
            ->when($type, function ($query, $type) {
                return $query->where('type', $type);
            })
            ->when($startDate, function ($query, $startDate) {
                return $query->whereDate('transaction_date', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                return $query->whereDate('transaction_date', '<=', $endDate);
            })
            ->when($search, function ($query, $search) {
                return $query->where('description', 'like', '%' . $search . '%')
                             ->orWhere('amount', 'like', '%' . $search . '%');
            })
            ->paginate(15); // Tingkatkan paginasi

        // Hitung total untuk summary cards di laporan
        $totalPemasukan = Transaction::when($type, function ($query, $type) {
                                return $query->where('type', $type);
                            })
                            ->when($startDate, function ($query, $startDate) {
                                return $query->whereDate('transaction_date', '>=', $startDate);
                            })
                            ->when($endDate, function ($query, $endDate) {
                                return $query->whereDate('transaction_date', '<=', $endDate);
                            })
                            ->where('type', 'kredit')
                            ->sum('amount');

        $totalPengeluaran = Transaction::when($type, function ($query, $type) {
                                return $query->where('type', $type);
                            })
                            ->when($startDate, function ($query, $startDate) {
                                return $query->whereDate('transaction_date', '>=', $startDate);
                            })
                            ->when($endDate, function ($query, $endDate) {
                                return $query->whereDate('transaction_date', '<=', $endDate);
                            })
                            ->where('type', 'debit')
                            ->sum('amount');

        $labaRugiBersih = $totalPemasukan - $totalPengeluaran;


        return view('admin.reports.financial', compact(
            'transactions', 'type', 'startDate', 'endDate', 'search',
            'totalPemasukan', 'totalPengeluaran', 'labaRugiBersih'
        ));
    }

    /**
     * Export transactions to Excel.
     */
    public function export()
    {
        // Ambil semua transaksi tanpa paginasi untuk diekspor
        // Anda bisa menambahkan filter di sini juga jika ingin export data yang difilter
        $transactions = Transaction::all();
        return Excel::download(new TransactionsExport($transactions), 'laporan_transaksi.xlsx');
    }

    /**
     * Show form for import.
     */
    public function showImportForm()
    {
        return view('admin.reports.import'); // View untuk form import
    }

    /**
     * Import transactions from Excel.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048', // Hanya boleh Excel/CSV, max 2MB
        ]);

        try {
            Excel::import(new TransactionsImport, $request->file('file'));
        } catch (ValidationException $e) {
            // Menangkap error validasi dari import, jika ada baris yang invalid
            $failures = $e->failures();
            $errors = [];
            foreach ($failures as $failure) {
                $errors[] = 'Baris ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            }
            return redirect()->back()->withErrors($errors)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengimpor file: ' . $e->getMessage());
        }

        return redirect()->route('reports.financial')->with('success', 'Transaksi berhasil diimpor!');
    }
}
