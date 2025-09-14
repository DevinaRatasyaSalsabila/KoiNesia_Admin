<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerAPIController;

Route::get('/products', [SellerAPIController::class, 'index']);

Route::get('/test', function () {
    return response()->json(['message' => 'API jalan!']);
});
