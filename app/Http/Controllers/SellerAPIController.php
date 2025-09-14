<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class SellerAPIController extends Controller
{
      public function index()
    {
        return response()->json(Produk::all());
    }
}
