<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DasboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProdukController;
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

//daftar barang masuk
Route::get('/barang-masuk', [BarangMasukController::class, 'index']);

//daftar produk
Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/produk/tambah', [ProdukController::class, 'create']);
Route::get('/produk/detail', [ProdukController::class, 'show']);
Route::get('/produk/edit', [ProdukController::class, 'edit']);
