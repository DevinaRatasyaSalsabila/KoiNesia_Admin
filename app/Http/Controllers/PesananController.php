<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembeli = Pembeli::all();
        $produk = Produk::all();
        $pesanan = DB::table('pesanan')
            ->join('pembeli', 'pesanan.id_pembeli', '=', 'pembeli.id_pembeli')
            ->select('pesanan.*', 'pembeli.nama_pembeli', 'pembeli.no_hp', 'pembeli.alamat')
            ->get();

        // Tambahkan info produk per pesanan
        $pesanan->transform(function ($item) {
            // kode_produk disimpan sebagai JSON
            $produk_ids = json_decode($item->kode_produk, true); // array of kode_produk
            if ($produk_ids) {
                $item->produk_detail = DB::table('produk')
                    ->whereIn('kode_produk', $produk_ids)
                    ->get();
            } else {
                $item->produk_detail = collect();
            }
            return $item;
        });
        return view('pesanan.index', compact('produk', 'pembeli', 'pesanan'));
    }

    /**
     * Show the form for creating a new resource
     */
    public function create()
    {
        //
    }

    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $status = $request->status; // harus sesuai key di AJAX
        if (!in_array($status, ['baru', 'proses'])) {
            return response()->json(['error' => 'Status tidak valid'], 400);
        }

        $pesanan->status = $status;
        $pesanan->save();

        return response()->json(['success' => true, 'status' => $pesanan->status]);
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
    public function show()
    {
        return view('pesanan.modal.detail');
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
