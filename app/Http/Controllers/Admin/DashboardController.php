<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction; // Impor model Transaction
use Carbon\Carbon; // Impor Carbon untuk manipulasi tanggal

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data untuk periode bulan ini (atau sesuaikan)
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Hitung total pemasukan dan pengeluaran bulan ini
        $totalPemasukan = Transaction::where('type', 'kredit')
                                    ->whereBetween('transaction_date', [$startOfMonth, $endOfMonth])
                                    ->sum('amount');

        $totalPengeluaran = Transaction::where('type', 'debit')
                                      ->whereBetween('transaction_date', [$startOfMonth, $endOfMonth])
                                      ->sum('amount');

        $labaRugiBersih = $totalPemasukan - $totalPengeluaran;

        // --- Data untuk Chart (Pemasukan vs Pengeluaran Bulanan) ---
        $months = []; // Label bulan
        $monthlyIncomeData = []; // Data pemasukan per bulan
        $monthlyExpenseData = []; // Data pengeluaran per bulan

        // Ambil data untuk 12 bulan terakhir atau setahun penuh
        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::create(null, $i, 1)->format('M'); // Jan, Feb, dst.
            $months[] = $monthName;

            $income = Transaction::where('type', 'kredit')
                                 ->whereYear('transaction_date', Carbon::now()->year)
                                 ->whereMonth('transaction_date', $i)
                                 ->sum('amount');

            $expense = Transaction::where('type', 'debit')
                                  ->whereYear('transaction_date', Carbon::now()->year)
                                  ->whereMonth('transaction_date', $i)
                                  ->sum('amount');

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
