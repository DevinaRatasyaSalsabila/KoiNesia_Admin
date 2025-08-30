<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DasboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengeluaranController;
use Illuminate\Support\Facades\Route;

Route::get('/main', function () {
    return view('main');
});


//login
Route::get('/', [LoginController::class, 'index']);

//dashboard
Route::get('/dashboard', [DasboardController::class, 'index']);

//daftar-admin
Route::get('/daftar-admin', [AdminController::class, 'index']);

//daftar-pengeluaran
Route::get('/pengeluaran', [PengeluaranController::class, 'index']);