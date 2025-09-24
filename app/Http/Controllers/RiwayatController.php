<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Pembeli;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanan = Pesanan::where('status', 'selesai')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('kode_pesanan');

        $pesananSelesai = Pesanan::where('status', 'selesai')
            ->sum('nominal');

        $pesananData = $pesanan->map(function ($listPesanan) {
            $first = $listPesanan->first();

            $namaPembeli = Pembeli::where('id_pembeli', $first->id_pembeli)->value('nama_pembeli');

            return [
                'kode_pesanan' => $first->kode_pesanan,
                'tanggal'      => $first->created_at->format('d-m-Y'),
                'nama_pembeli' => $namaPembeli,
                'total_nominal' => $listPesanan->sum('nominal'),
            ];
        });

        return view('riwayat.index', [
            'pesanan' => $pesananData,
            'pesananSelesai' => $pesananSelesai,
        ]);
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
    // public function show(string $id)
    public function show(string $kodePesanan)
    {
        $items = Pesanan::where('kode_pesanan', $kodePesanan)
            ->join('produk', 'pesanan.kode_produk', '=', 'produk.kode_produk')
            ->select(
                'produk.nama_produk',
                'produk.harga_Satuan',
                'pesanan.jumlah',
                'pesanan.nominal'
            )
            ->get();

        $pesanan = Pesanan::where('kode_pesanan', $kodePesanan)->firstOrFail();
        $pembeli = Pembeli::find($pesanan->id_pembeli);

        $totalKeseluruhan = $items->sum('nominal');

        return view('riwayat.detail', compact('pesanan', 'pembeli', 'items', 'totalKeseluruhan'));
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
