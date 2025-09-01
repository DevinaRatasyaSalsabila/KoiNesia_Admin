<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DasboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PesananController;
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
Route::post('/produk/add', [ProdukController::class, 'store'])->name('produk.add');
Route::get('/produk/detail', [ProdukController::class, 'show']);
Route::get('/produk/edit', [ProdukController::class, 'edit']);

// pesanan
Route::get('/pesanan', [PesananController::class, 'index']);
// Login
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/loginsubmit', [LoginController::class, 'submit'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//dashboard
Route::get('/dashboard', [DasboardController::class, 'index'])->name('dashboard')->middleware('auth');

//daftar-admin
Route::get('/daftar-admin', [AdminController::class, 'index']);
Route::post('/tambah-admin', [AdminController::class, 'store'])->name('admin.add');
Route::put('/edit-admin/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/delete-admin/{id}', [AdminController::class, 'destroy'])->name('admin.delete');

//daftar-pengeluaran
Route::get('/pengeluaran', [PengeluaranController::class, 'index']);
Route::post('/tambah-pengeluaran', [PengeluaranController::class, 'store'])->name('pengeluaran.add');
Route::put('/edit-pengeluaran/{id}', [PengeluaranController::class, 'update'])->name('pengeluaran.update');
Route::delete('/delete-pengeluaran/{id}', [PengeluaranController::class, 'destroy'])->name('pengeluaran.delete');

// pesanan
Route::get('/pesanan', [PesananController::class, 'index']);
Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.add');
Route::get('/detail', [PesananController::class, 'show']);
