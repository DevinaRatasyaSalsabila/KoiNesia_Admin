<?php

use App\Http\Controllers\DasboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesananController;
use Illuminate\Support\Facades\Route;

Route::get('/main', function () {
    return view('main');
});

Route::get('/', [LoginController::class, 'index']);
Route::get('/dashboard', [DasboardController::class, 'index']);
Route::get('/pesanan', [PesananController::class, 'index']);
Route::get('/detail', [PesananController::class, 'show']);
