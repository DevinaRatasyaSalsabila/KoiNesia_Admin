<?php

use App\Http\Controllers\DasboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/main', function () {
    return view('main');
});

Route::get('/', [LoginController::class, 'index']);
Route::get('/dashboard', [DasboardController::class, 'index']);