<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController;
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
    Route::get('/reports/financial', function () {
        return view('admin.reports.financial'); // Nanti kita buat file ini
    })->name('reports.financial');

    // --- Akhir Rute Admin Panel Anda ---
});

require __DIR__.'/auth.php';
