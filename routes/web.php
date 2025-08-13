<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\FinancialReportController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\InvoiceController;
use Illuminate\Support\Facades\Route;

// --- Rute Area Publik ---
Route::get('/', [PublicController::class, 'homepage'])->name('homepage');
Route::get('/e-catalog', [PublicController::class, 'catalog'])->name('catalog.index'); 
Route::get('/e-catalog/{product}', [PublicController::class, 'productDetail'])->name('catalog.show'); 
Route::get('/about', [PublicController::class, 'about'])->name('about.index'); 
Route::get('/contact', [PublicController::class, 'contact'])->name('contact.index'); 


Route::get('/dashboard', [DashboardController::class, 'index']) 
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/categories', CategoryController::class)->except(['show']);

    Route::resource('products', ProductController::class);

    Route::resource('invoices', InvoiceController::class);

    // Route::resource('transactions', TransactionController::class)->except(['show']); // Dinonaktifkan

    Route::get('/reports/financial', [FinancialReportController::class, 'index'])->name('reports.financial');
    Route::get('/reports/financial/export', [FinancialReportController::class, 'export'])->name('reports.financial.export');
    Route::get('/reports/financial/import', [FinancialReportController::class, 'showImportForm'])->name('reports.financial.import');
    Route::post('/reports/financial/import', [FinancialReportController::class, 'import'])->name('reports.financial.do_import');

    Route::get('invoices/{invoice}/pdf', [InvoiceController::class, 'downloadPdf'])->name('invoices.downloadPdf');

});

require __DIR__.'/auth.php';
