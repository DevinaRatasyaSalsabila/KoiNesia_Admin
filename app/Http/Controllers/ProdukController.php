<?php

namespace App\Http\Controllers;

use App\Imports\ProdukImport;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

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

        $filenames = [];

        if ($request->has('gambar_produk')) {
            foreach ($request->gambar_produk as $fileOrBase64) {
                // kalau base64 (image)
                if (Str::startsWith($fileOrBase64, 'data:image')) {
                    $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $fileOrBase64));
                    $filename = uniqid() . '.png';
                    Storage::disk('public')->put('produk/final/' . $filename, $image);
                    $filenames[] = $filename;
                }
            }
        }

        if ($request->hasFile('video_files')) {
            foreach ($request->file('video_files') as $video) {
                $filename = uniqid() . '.' . $video->getClientOriginalExtension();
                $video->storeAs('produk/final', $filename, 'public');
                $filenames[] = $filename;
            }
        }

        $produk = Produk::create([
            'nama_produk'      => $request->nama_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'gambar_produk'    => json_encode($filenames),
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

        $filenames = [];

        if ($request->has('gambar_produk')) {
            foreach ($request->gambar_produk as $img) {
                if (Str::startsWith($img, 'data:image')) {
                    $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img));
                    $filename = uniqid() . '.png';
                    Storage::disk('public')->put('produk/final/' . $filename, $image);
                    $filenames[] = $filename;
                }
            }
        }

        if ($request->hasFile('video_files')) {
            foreach ($request->file('video_files') as $video) {
                $videoName = uniqid() . '.' . $video->getClientOriginalExtension();
                $video->storeAs('produk/final', $videoName, 'public');
                $filenames[] = $videoName;
            }
        }

        if (!empty($filenames)) {
            $data['gambar_produk'] = json_encode($filenames);
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->gambar_produk) {
            $files = json_decode($produk->gambar_produk, true); // decode ke array

            if (is_array($files)) {
                foreach ($files as $file) {
                    $filePath = 'produk/final/' . $file;

                    if (Storage::disk('public')->exists($filePath)) {
                        Storage::disk('public')->delete($filePath);
                    }
                }
            }
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new ProdukImport, $request->file('file'));

        return back()->with('sukses', 'Data produk berhasil diimport.');
    }
}
