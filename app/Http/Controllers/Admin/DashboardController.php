<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice; // Ganti ke Invoice
use Carbon\Carbon; // Impor Carbon untuk manipulasi tanggal

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter untuk grafik
        $granularity = $request->input('granularity', 'month'); // month | quarter | year
        if (!in_array($granularity, ['month', 'quarter', 'year'])) {
            $granularity = 'month';
        }
        $selectedYear = (int) $request->input('year', Carbon::now()->year);

        // Ambil data untuk periode bulan ini (untuk cards)
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

        // --- Data untuk Chart (Pemasukan vs Pengeluaran berdasarkan granularitas) ---
        $months = []; // label sumbu X (dipakai nama variabel existing)
        $monthlyIncomeData = []; // dataset pemasukan
        $monthlyExpenseData = []; // dataset pengeluaran

        if ($granularity === 'month') {
            for ($i = 1; $i <= 12; $i++) {
                $monthName = Carbon::create(null, $i, 1)->format('M');
                $months[] = $monthName;

                $income = Invoice::where('type', 'kredit')
                                 ->whereYear('invoice_date', $selectedYear)
                                 ->whereMonth('invoice_date', $i)
                                 ->sum('total_amount');

                $expense = Invoice::where('type', 'debit')
                                  ->whereYear('invoice_date', $selectedYear)
                                  ->whereMonth('invoice_date', $i)
                                  ->sum('total_amount');

                $monthlyIncomeData[] = $income;
                $monthlyExpenseData[] = $expense;
            }
        } elseif ($granularity === 'quarter') {
            for ($q = 1; $q <= 4; $q++) {
                $startMonth = ($q - 1) * 3 + 1;
                $endMonth = $q * 3;
                $months[] = 'Q' . $q;

                $income = Invoice::where('type', 'kredit')
                                 ->whereYear('invoice_date', $selectedYear)
                                 ->whereMonth('invoice_date', '>=', $startMonth)
                                 ->whereMonth('invoice_date', '<=', $endMonth)
                                 ->sum('total_amount');

                $expense = Invoice::where('type', 'debit')
                                  ->whereYear('invoice_date', $selectedYear)
                                  ->whereMonth('invoice_date', '>=', $startMonth)
                                  ->whereMonth('invoice_date', '<=', $endMonth)
                                  ->sum('total_amount');

                $monthlyIncomeData[] = $income;
                $monthlyExpenseData[] = $expense;
            }
        } else { // year
            // Ambil 5 tahun terakhir hingga selectedYear
            for ($y = $selectedYear - 4; $y <= $selectedYear; $y++) {
                $months[] = (string) $y;

                $income = Invoice::where('type', 'kredit')
                                 ->whereYear('invoice_date', $y)
                                 ->sum('total_amount');

                $expense = Invoice::where('type', 'debit')
                                  ->whereYear('invoice_date', $y)
                                  ->sum('total_amount');

                $monthlyIncomeData[] = $income;
                $monthlyExpenseData[] = $expense;
            }
        }

        return view('dashboard', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'labaRugiBersih',
            'months',
            'monthlyIncomeData',
            'monthlyExpenseData',
            'granularity',
            'selectedYear'
        ));
    }
}
