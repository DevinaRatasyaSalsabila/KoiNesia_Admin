<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
    public function store(Request $request)
    {
        $pembeli = Pembeli::create([
            'nama_pembeli' => $request->nama_pembeli,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return response()->json([
            'success' => true,
            'pembeli' => $pembeli
        ]);
    }
}
