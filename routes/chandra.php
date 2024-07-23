<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware('auth')->group(function () {
    Route::get('/bayarkas', [App\Http\Controllers\IncomeController::class, 'index'])->name('incomes');
    Route::post('/bayarkas/tambah', [App\Http\Controllers\IncomeController::class, 'store'])->name('incomes.store');
});
