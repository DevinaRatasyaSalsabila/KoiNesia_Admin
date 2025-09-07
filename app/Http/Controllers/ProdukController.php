<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        return view('produk.tambah');
    }

    public function upload(Request $request)
    {
        // if ($request->hasFile('file')) {
        //     $file = $request->file('file');
        //     $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        //     $path = $file->storeAs('produk/final', $filename, 'public');

        //     return response()->json([
        //         'success' => true,
        //         'path'    => 'storage/' . $path,   // buat hidden input
        //         'url'     => asset('storage/' . $path), // buat preview kalau mau
        //     ]);
        // }

        // return response()->json(['success' => false], 400);
    }

    public function store(Request $request)
    {
        Log::info('📦 Data diterima store()', $request->all());

        $request->validate([
            'nama_produk'      => 'required|string|max:255',
            'deskripsi_produk' => 'required|string',
            'kode_produk'      => 'required|string|max:100',
            'stok_produk'      => 'required|integer',
            'ukuran_produk'    => 'required|string|max:50',
            'harga_produk'     => 'required|integer',
            'gambar_produk'    => 'required|array',
        ]);

        $paths = [];

        foreach ($request->gambar_produk as $base64) {
            if (preg_match('/^data:image\/(\w+);base64,/', $base64, $type)) {
                $image = substr($base64, strpos($base64, ',') + 1);
                $type = strtolower($type[1]);

                $image = base64_decode($image);
                $filename = uniqid() . '.' . $type;
                $path = 'produk/final/' . $filename;

                Storage::disk('public')->put($path, $image);

                $paths[] = $filename; 
            }
        }

        $produk = Produk::create([
            'nama_produk'      => $request->nama_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'gambar_produk'    => json_encode($paths),
            'kode_produk'      => $request->kode_produk,
            'stok_produk'      => $request->stok_produk,
            'ukuran_produk'    => $request->ukuran_produk,
            'harga_satuan'     => $request->harga_produk,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.detail', compact('produk'));
    }

    public function edit(string $id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_produk'      => 'required|string|max:255',
            'deskripsi_produk' => 'required|string',
            'kode_produk'      => 'required|string|max:100',
            'stok_produk'      => 'required|integer',
            'ukuran_produk'    => 'required|string|max:50',
            'harga_produk'     => 'required|integer',
        ]);

        $produk = Produk::findOrFail($id);

        $data = [
            'nama_produk'      => $request->nama_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'kode_produk'      => $request->kode_produk,
            'stok_produk'      => $request->stok_produk,
            'ukuran_produk'    => $request->ukuran_produk,
            'harga_Satuan'     => $request->harga_produk,
        ];

        // handle gambar baru
        if ($request->has('gambar_produk')) {
            $filenames = [];
            foreach ($request->gambar_produk as $img) {
                $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img));
                $filename = uniqid() . '.png';
                Storage::disk('public')->put('produk/final/' . $filename, $image);
                $filenames[] = $filename;
            }

            $data['gambar_produk'] = json_encode($filenames);
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->gambar_produk) {
            $filePath = 'produk/final/' . $produk->gambar_produk;

            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
