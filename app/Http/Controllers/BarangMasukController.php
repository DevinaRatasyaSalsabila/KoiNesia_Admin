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
        $request->validate([
            'barang_masuk.*.kode_produk' => 'required',
            'barang_masuk.*.total_produk' => 'required|integer',
            'barang_masuk.*.keterangan' => 'required',
            'barang_masuk.*.tanggal' => 'required|date',
        ]);

        foreach ($request->barang_masuk as $item) {
            BarangMasuk::create([
                'kode_produk'   => $item['kode_produk'],
                'total_produk'  => $item['total_produk'],
                'keterangan'    => $item['keterangan'],
                'tanggal'       => $item['tanggal'],
            ]);

            Produk::where('kode_produk', $item['kode_produk'])
                ->increment('stok_produk', $item['total_produk']);
        }

        return redirect('/barang-masuk')->with('success', 'Data barang masuk berhasil ditambahkan!');
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
    public function edit(string $id)
    {
        $barang = BarangMasuk::findorFail($id);
        $produk = Produk::all();

        return view('barang_masuk.edit', compact('barang', 'produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_produk'   => 'required',
            'total_produk'  => 'required|integer',
            'keterangan'    => 'required',
            'tanggal'       => 'required|date',
        ]);

        // Data lama barang masuk
        $barang = BarangMasuk::findOrFail($id);

        // Kalau kode_produk sama (cuma update jumlah)
        if ($request->kode_produk == $barang->kode_produk) {
            // Hitung selisih
            $selisih = $request->total_produk - $barang->total_produk;

            // Update stok produk sesuai selisih
            Produk::where('kode_produk', $barang->kode_produk)
                ->increment('stok_produk', $selisih);
        } else {
            // Kalau ganti kode_produk:
            // 1. Kurangi stok produk lama
            Produk::where('kode_produk', $barang->kode_produk)
                ->decrement('stok_produk', $barang->total_produk);

            // 2. Tambah stok ke produk baru
            Produk::where('kode_produk', $request->kode_produk)
                ->increment('stok_produk', $request->total_produk);
        }

        // Update data barang masuk
        $barang->update([
            'kode_produk'   => $request->kode_produk,
            'total_produk'  => $request->total_produk,
            'keterangan'    => $request->keterangan,
            'tanggal'       => $request->tanggal,
        ]);

        return redirect('/barang-masuk')->with('success', 'Data barang masuk berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
