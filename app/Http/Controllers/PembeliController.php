<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
    public function store(Request $request)
    {
        $noHp = $request->no_hp;

        if (substr($noHp, 0, 2) === '62') {
            $noHp = '0' . substr($noHp, 2);
        }

        if (substr($noHp, 0, 1) !== '0') {
            $noHp = '0' . $noHp;
        }

        $pembeli = Pembeli::create([
            'nama_pembeli' => $request->nama_pembeli,
            'no_hp' => $noHp,
            'alamat' => $request->alamat,
        ]);

        return response()->json([
            'success' => true,
            'pembeli' => $pembeli
        ]);
    }
}
