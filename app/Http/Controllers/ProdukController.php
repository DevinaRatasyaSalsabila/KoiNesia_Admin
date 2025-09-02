<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'required|string',
            'gambar' => 'nullable|array',
            'kode_produk' => 'required|string|max:100',
            'stok_produk' => 'required|integer',
            'ukuran_produk' => 'required|string|max:50',
            'harga_produk' => 'required|integer',
        ]);

        $finalPaths = [];

        if ($request->has('gambar')) {
            foreach ($request->gambar as $tempPath) {
                // pindahin dari temp ke final
                $filename = basename($tempPath);
                $newPath = "produk/final/" . $filename;

                if (Storage::disk('public')->exists($tempPath)) {
                    Storage::disk('public')->move($tempPath, $newPath);
                    $finalPaths[] = $newPath;
                }
            }
        }
        dd($request->all());

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'gambar_produk' => json_encode($finalPaths),
            'kode_produk' => $request->kode_produk,
            'stok_produk' => $request->stok_produk,
            'ukuran_produk' => $request->ukuran_produk,
            'harga_satuan' => $request->harga_produk,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function uploadTemp(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('produk/temp', $filename, 'public');

            return response()->json([
                'success' => true,
                'path' => $path
            ]);
        }

        return response()->json(['success' => false], 400);
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
