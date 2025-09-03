<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DasboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\RiwayatController;
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
Route::get('/barang-masuk/tambah', [BarangMasukController::class, 'create']);
Route::get('/barang-masuk/edit', [BarangMasukController::class, 'edit']);
Route::get('/barang-masuk/detail', [BarangMasukController::class, 'show']);

//daftar produk
Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/produk/tambah', [ProdukController::class, 'create']);
Route::get('/produk/edit', [ProdukController::class, 'edit']);

//Riwayat Transaksi
Route::get('riwayat-transaksi', [RiwayatController::class, 'index']);
Route::get('riwayat-transaksi/detail', [RiwayatController::class, 'show']);

//rekap 
Route::get('rekap', [RekapController::class, 'index']);