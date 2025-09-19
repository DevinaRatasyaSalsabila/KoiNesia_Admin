<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DasboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\SellerAPIController;
use Illuminate\Support\Facades\Route;

Route::get('/main', function () {
    return view('main');
});

//dashboard
Route::get('/dashboard', [DasboardController::class, 'index'])->name('dashboard');

//daftar barang masuk
Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('barang-masuk.index');
Route::get('/barang-masuk/edit/{id}', [BarangMasukController::class, 'edit']);
Route::get('/barang-masuk/tambah', [BarangMasukController::class, 'create']);
Route::post('/barang-masuk/add', [BarangMasukController::class, 'store'])->name('barang-masuk.store');
Route::post('/barang-masuk/update/{id}', [BarangMasukController::class, 'update'])->name('barang-masuk.update');
Route::delete('/barang-masuk/delete/{id}', [BarangMasukController::class, 'destroy'])->name('barang-masuk.destroy');

//daftar produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/tambah', [ProdukController::class, 'create'])->name('produk.create');
Route::post('/produk/gambar', [ProdukController::class, 'upload'])->name('produk.upload');
Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
Route::get('/produk/detail/{id}', [ProdukController::class, 'show'])->name('produk.detail');
Route::get('/produk/edit/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
Route::put('/produk/update/{id}', [ProdukController::class, 'update'])->name('produk.update');
Route::delete('/produk/delete/{id}', [ProdukController::class, 'destroy'])->name('produk.delete');

// Login
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/loginsubmit', [LoginController::class, 'submit'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//dashboard
// Route::get('/dashboard', [DasboardController::class, 'index'])->name('dashboard')->middleware('auth');

//daftar-admin
Route::get('/daftar-admin', [AdminController::class, 'index']);
Route::post('/tambah-admin', [AdminController::class, 'store'])->name('admin.add');
Route::put('/edit-admin/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/delete-admin/{id}', [AdminController::class, 'destroy'])->name('admin.delete');

//daftar-pengeluaran
Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran.index');
Route::post('/tambah-pengeluaran', [PengeluaranController::class, 'store'])->name('pengeluaran.add');
Route::put('/edit-pengeluaran/{id}', [PengeluaranController::class, 'update'])->name('pengeluaran.update');
Route::delete('/delete-pengeluaran/{id}', [PengeluaranController::class, 'destroy'])->name('pengeluaran.delete');

// pesanan
Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
Route::post('/pesanan/tambah', [PesananController::class, 'store'])->name('pesanan.add');
Route::put('/pesanan/update/{kode_pesanan}', [PesananController::class, 'update'])->name('pesanan.update');
Route::get('/detail/{id}', [PesananController::class, 'show'])->name('pesanan.detail');
Route::post('/pesanan/{id}/status', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
Route::delete('/pesanan/{id}', [PesananController::class, 'destroy'])->name('pesanan.delete');

//pembeli - pesanan
Route::post('pembeli', [PembeliController::class, 'store'])->name('pembeli.add');

//Riwayat Transaksi
Route::get('riwayat-transaksi', [RiwayatController::class, 'index'])->name('riwayat.index');
Route::get('riwayat-transaksi/detail', [RiwayatController::class, 'show']);

//rekap
Route::get('rekap', [RekapController::class, 'index'])->name('rekap.index');


//tes api wa
Route::get('/form-wa', function () {
    return view('form-wa'); // view form nanti
});

Route::post('/kirim-wa', [SellerAPIController::class, 'pesan'])->name('kirim.wa');
