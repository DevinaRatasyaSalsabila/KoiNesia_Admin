<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        return view('produk.index');
    }

    public function create()
    {
        return view('produk.tambah');
    }

    public function store(Request $request)
    {
        $produk = Produk::create([
            'nama_produk'  => $request->nama_produk,
            'harga_satuan' => $request->harga_produk,
            'stok'         => "2",
            'ukuran'       => $request->ukuran,
            'deskripsi'    => $request->deskripsi_produk,
            'kode_produk'  => "200K",
        ]);

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $filename = time() . '-' . $file->getClientOriginalName();
                $path = $file->storeAs('produk', $filename, 'public');

                $gambar[] = $path;
            }

            $produk->update([
                'gambar' => json_encode($gambar ?? [])
            ]);
        }

        dd($request->all());
        return back()->with('success', 'Produk berhasil disimpan');
    }


    // public function show(string $id)
    public function show()
    {
        return view('produk.detail');
    }

    // public function edit(string $id)
    public function edit()
    {
        return view('produk.edit');
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
