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
        Log::info("📥 upload() dipanggil", [
            'has_file'   => $request->hasFile('file'),
            'all_files'  => $request->allFiles(),
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('produk/final', $filename, 'public');

            Log::info("✅ File berhasil diupload", [
                'original_name' => $file->getClientOriginalName(),
                'stored_as'     => $path,
                'public_url'    => asset('storage/' . $path)
            ]);

            return response()->json([
                'success' => true,
                'path'    => 'storage/' . $path
            ]);
        }

        Log::warning("⚠️ Tidak ada file diterima di upload()");
        return response()->json(['success' => false], 400);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk'      => 'required|string|max:255',
            'deskripsi_produk' => 'required|string',
            'kode_produk'      => 'required|string|max:100',
            'stok_produk'      => 'required|integer',
            'ukuran_produk'    => 'required|string|max:50',
            'harga_produk'     => 'required|integer',
        ]);


        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('produk/final', $filename, 'public');

            $produk = Produk::create([
                'nama_produk'      => $request->nama_produk,
                'deskripsi_produk' => $request->deskripsi_produk,
                'gambar_produk'    => $filename,
                'kode_produk'      => $request->kode_produk,
                'stok_produk'      => $request->stok_produk,
                'ukuran_produk'    => $request->ukuran_produk,
                'harga_satuan'     => $request->harga_produk,
            ]);
        }

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
            'harga_satuan'     => $request->harga_produk,
        ];

        if ($request->hasFile('gambar_produk')) {
            $file = $request->file('gambar_produk');

            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            $file->storeAs('produk/final', $filename, 'public');

            $data['gambar_produk'] = $filename;
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
