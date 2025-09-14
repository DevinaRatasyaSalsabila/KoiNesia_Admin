<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Produk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = BarangMasuk::all();
        foreach ($barang as $b) {
            $produk = Produk::where('kode_produk', $b->kode_produk)->value('nama_produk');
        }
        return view('barang_masuk.index', compact('barang', 'produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produk = Produk::all();
        return view('barang_masuk.tambah', compact('produk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        BarangMasuk::create([
            'kode_produk' => $request->kode_produk,
            'total_produk' => $request->total_produk,
            'keterangan' => $request->keterangan
        ]);

        return redirect('/barang-masuk');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    //public function edit(string $id)
    public function edit()
    {
        return view('barang_masuk.edit');
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
