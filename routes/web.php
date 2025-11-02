<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DasboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\SellerAPIController;
use Illuminate\Support\Facades\Route;

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/loginsubmit', [LoginController::class, 'submit'])->name('login.submit');

Route::middleware(['middlewareLogin'])->group(function () {
    //dashboard
    Route::get('/dashboard', [DasboardController::class, 'index'])->name('dashboard');

    //daftar barang masuk
    Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('barang-masuk.index');
    Route::get('/barang-masuk/edit/{id}', [BarangMasukController::class, 'edit']);
    Route::get('/barang-masuk/tambah', [BarangMasukController::class, 'create']);
    Route::post('/barang-masuk/add', [BarangMasukController::class, 'store'])->name('barang-masuk.store');
    Route::post('/barang-masuk/update/{id}', [BarangMasukController::class, 'update'])->name('barang-masuk.update');
    Route::delete('/barang-masuk/delete/{id}', [BarangMasukController::class, 'destroy'])->name('barang-masuk.destroy');
    Route::post('/barang-masuk/import', [BarangMasukController::class, 'import'])->name('barang-masuk.import');

    //daftar produk
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/tambah', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk/gambar', [ProdukController::class, 'upload'])->name('produk.upload');
    Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/detail/{id}', [ProdukController::class, 'show'])->name('produk.detail');
    Route::get('/produk/edit/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/update/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/delete/{id}', [ProdukController::class, 'destroy'])->name('produk.delete');
    Route::post('/produk/import', [ProdukController::class, 'import'])->name('produk.import');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

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
    Route::post('/pengeluran/import', [PengeluaranController::class, 'import'])->name('pengeluaran.import');

    // pesanan
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::post('/pesanan/tambah', [PesananController::class, 'store'])->name('pesanan.add');
    Route::put('/pesanan/update/{kode_pesanan}', [PesananController::class, 'update'])->name('pesanan.update');
    Route::get('/detail/{id}', [PesananController::class, 'show'])->name('pesanan.detail');
    Route::post('/pesanan/{id}/status', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
    Route::delete('/pesanan/{id}', [PesananController::class, 'destroy'])->name('pesanan.delete');
    Route::get('/pesanan/print', [PesananController::class, 'print'])->name('pesananPrint');

    //pembeli - pesanan
    Route::post('pembeli', [PembeliController::class, 'store'])->name('pembeli.add');

    //Riwayat Transaksi
    Route::get('riwayat-transaksi', [RiwayatController::class, 'index'])->name('riwayat.index');
    Route::get('riwayat-transaksi/detail/{id}', [RiwayatController::class, 'show'])->name('riwayat.detail');

    //rekap
    Route::get('rekap', [RekapController::class, 'index'])->name('rekap.index');
    Route::get('/rekap/filter', [RekapController::class, 'filter'])->name('rekap.filter');
});
//tes api wa
Route::get('/form-wa', function () {
    return view('form-wa'); // view form nanti
});

Route::post('/kirim-wa', [SellerAPIController::class, 'pesan'])->name('kirim.wa');



Route::get('/', [PelangganController::class, 'beranda'])->name('dashboard.pelanggan');
Route::prefix('pelanggan')->group(function () {
    Route::get('/keranjang', [PelangganController::class, 'keranjang'])->name('keranjang');
    Route::get('/keranjang/pesanan', [PelangganController::class, 'format'])->name('format');
    // Route::get('/produk', [PelangganController::class, 'produkLengkap'])->name('produkLengkap');
    Route::get('/produk-lengkap', [PelangganController::class, 'produk_lengkap'])->name('produkLengkap');
    Route::post('/pesanan/kirim', [PelangganController::class, 'kirim'])->name('pesanan.kirim');
});

Route::get('/resi', function () {
    return view('pesanan.resi'); // view form nanti
});
// Route::get('/detail', function () {
//     return view('pelanggan.detail_produk.index'); // view form nanti
// });

// Route::get('/pelanggan/produk-lengkap', [PelangganController::class, 'produk_lengkap'])->name('produkLengkap');
