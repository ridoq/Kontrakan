<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware('auth')->group(function () {
    //Reject Uang Kas
    Route::post('/bayarkas/reject/{income}', [App\Http\Controllers\IncomeController::class, 'reject'])->name('incomes.reject');
    Route::delete('/bayarkas/cancel/{income}', [App\Http\Controllers\IncomeController::class, 'cancel'])->name('incomes.cancel');
});
