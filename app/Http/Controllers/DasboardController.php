<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DasboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::all();
        $pesanan = Pesanan::all();
        $pesananSelesai = Pesanan::where('status', 'selesai')->get();

        $pesananNew = Pesanan::where('status', 'selesai')
            ->select(
                'kode_pesanan',
                DB::raw('MAX(created_at) as tanggal'),
                DB::raw('SUM(nominal) as total_nominal'),
                DB::raw('MAX(id_pembeli) as id_pembeli')
            )
            ->groupBy('kode_pesanan')
            ->orderBy('tanggal', 'desc')
            ->take(5)
            ->get();

            // dd($pesananNew);
        foreach ($pesananNew as $item) {
            $item->nama_pembeli = Pembeli::where('id_pembeli', $item->id_pembeli)->value('nama_pembeli');
        }
        return view('dashboard.index', compact('produk', 'pesanan', 'pesananSelesai', 'pesananNew'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
