<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware('auth')->group(function () {
    Route::get('/bayarkas', [App\Http\Controllers\IncomeController::class, 'index'])->name('incomes');
    Route::post('/bayarkas/tambah', [App\Http\Controllers\IncomeController::class, 'store'])->name('incomes.store');
    Route::get('/keuangan', [App\Http\Controllers\FinancialController::class, 'index'])->name('financials');
    Route::get('/pengeluaran', [App\Http\Controllers\ExpenseController::class, 'index'])->name('expenses');
    Route::post('/pengeluaran/tambah', [App\Http\Controllers\ExpenseController::class, 'store'])->name('expenses.store');
});
