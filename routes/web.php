<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);
Route::middleware('auth')->group(function () {
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('/anggota', [App\Http\Controllers\UserController::class, 'index'])->name('members');
    Route::get('/anggota/tambah', [App\Http\Controllers\UserController::class, 'store'])->name('members.store');
    Route::put('/anggota/edit/{anggota}', [App\Http\Controllers\UserController::class, 'update'])->name('members.update');
});



require_once __DIR__ . '/chandra.php';
require_once __DIR__ . '/ridoq.php';
