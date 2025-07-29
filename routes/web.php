<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\FinancialReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index']) // Ubah baris ini
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- Rute Admin Panel Anda ---

    // Rute Kategori Produk
    Route::resource('/categories', CategoryController::class)->except(['show']);

    // Rute Dummy untuk Produk
    Route::resource('products', ProductController::class);

    // Rute Dummy untuk Transaksi
    Route::resource('transactions', TransactionController::class)->except(['show']);

    // Rute Dummy untuk Laporan Keuangan
    Route::get('/reports/financial', [FinancialReportController::class, 'index'])->name('reports.financial');
    Route::get('/reports/financial/export', [FinancialReportController::class, 'export'])->name('reports.financial.export');
    Route::get('/reports/financial/import', [FinancialReportController::class, 'showImportForm'])->name('reports.financial.import');
    Route::post('/reports/financial/import', [FinancialReportController::class, 'import'])->name('reports.financial.do_import');


    // --- Akhir Rute Admin Panel Anda ---
});

require __DIR__.'/auth.php';
