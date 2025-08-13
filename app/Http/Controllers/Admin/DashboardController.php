<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice; // Ganti ke Invoice
use Carbon\Carbon; // Impor Carbon untuk manipulasi tanggal

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data untuk periode bulan ini (atau sesuaikan)
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Hitung total pemasukan dan pengeluaran bulan ini dari invoice
        $totalPemasukan = Invoice::where('type', 'kredit')
                                ->whereBetween('invoice_date', [$startOfMonth, $endOfMonth])
                                ->sum('total_amount');

        $totalPengeluaran = Invoice::where('type', 'debit')
                                  ->whereBetween('invoice_date', [$startOfMonth, $endOfMonth])
                                  ->sum('total_amount');

        $labaRugiBersih = $totalPemasukan - $totalPengeluaran;

        // --- Data untuk Chart (Pemasukan vs Pengeluaran Bulanan) ---
        $months = []; // Label bulan
        $monthlyIncomeData = []; // Data pemasukan per bulan
        $monthlyExpenseData = []; // Data pengeluaran per bulan

        // Ambil data untuk 12 bulan terakhir atau setahun penuh
        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::create(null, $i, 1)->format('M'); // Jan, Feb, dst.
            $months[] = $monthName;

            $income = Invoice::where('type', 'kredit')
                             ->whereYear('invoice_date', Carbon::now()->year)
                             ->whereMonth('invoice_date', $i)
                             ->sum('total_amount');

            $expense = Invoice::where('type', 'debit')
                              ->whereYear('invoice_date', Carbon::now()->year)
                              ->whereMonth('invoice_date', $i)
                              ->sum('total_amount');

            $monthlyIncomeData[] = $income;
            $monthlyExpenseData[] = $expense;
        }


        return view('dashboard', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'labaRugiBersih',
            'months',
            'monthlyIncomeData',
            'monthlyExpenseData'
        ));
    }
}
