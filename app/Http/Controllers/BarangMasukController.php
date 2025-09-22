<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = BarangMasuk::all()->map(function ($item) {
            // tambahin field baru 'nama_produk' langsung ke setiap item
            $item->nama_produk = Produk::where('kode_produk', $item->kode_produk)->value('nama_produk');
            return $item;
        });

        return view('barang_masuk.index', compact('barang'));
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

        DB::transaction(function () use ($request, $id) {
            $barang = BarangMasuk::findOrFail($id);

            $lama  = $barang->kode_produk;
            $totalLama = (int) $barang->total_produk;
            $baru  = $request->kode_produk;
            $totalBaru = (int) $request->total_produk;

            if ($lama === $baru) {
                $delta = $totalBaru - $totalLama;

                if ($delta > 0) {
                    Produk::where('kode_produk', $lama)->increment('stok_produk', $delta);
                } elseif ($delta < 0) {
                    $decr = abs($delta);
                    $produk = Produk::where('kode_produk', $lama)->firstOrFail();
                    $produk->stok_produk = max(0, (int)$produk->stok_produk - $decr);
                    $produk->save();
                }
            } else {
                $produkLama = Produk::where('kode_produk', $lama)->firstOrFail();
                $produkLama->stok_produk = max(0, (int)$produkLama->stok_produk - $totalLama);
                $produkLama->save();

                $produkBaru = Produk::where('kode_produk', $baru)->firstOrFail();
                $produkBaru->increment('stok_produk', $totalBaru);
            }

            $barang->update([
                'kode_produk'   => $baru,
                'total_produk'  => $totalBaru,
                'keterangan'    => $request->keterangan,
                'tanggal'       => $request->tanggal,
            ]);
        });

        return redirect('/barang-masuk')->with('success', 'Data barang masuk berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = BarangMasuk::find($id);
        // $barang->delete();

        //iki fungsi lk  barang masok di hapus, stok produk di kurangi
        // $barang = BarangMasuk::where('kode_produk', $barang->kode_produk)->first();
        // $barangKurang = Produk::where('kode_produk', $barang->kode_produk)->first();
        // $barangKurang->stok_produk = $barangKurang->stok_produk - $barang->total_produk;
        // $barangKurang->save();
        // $barang->delete();
        return redirect()->back()->with('success', 'Data Barang Masuk Berhasil Dihapus');
    }
}
