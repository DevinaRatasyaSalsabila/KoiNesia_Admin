<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Str;

class PesananController extends Controller
{
    public function index()
    {
        $pembeli = Pembeli::all();
        $produk = Produk::all();

        $pesanan = DB::table('pesanan')
            ->join('pembeli', 'pesanan.id_pembeli', '=', 'pembeli.id_pembeli')
            ->select(
                'pesanan.kode_pesanan',
                'pesanan.id_pembeli',
                'pesanan.user_id',
                'pesanan.status',
                'pesanan.nominal',
                'pembeli.nama_pembeli',
                'pembeli.no_hp',
                'pembeli.alamat',
                'pembeli.created_at'
            )
            ->groupBy(
                'pesanan.kode_pesanan',
                'pesanan.id_pembeli',
                'pesanan.user_id',
                'pesanan.status',
                'pesanan.nominal',
                'pembeli.nama_pembeli',
                'pembeli.no_hp',
                'pembeli.alamat'
            )
            ->get();

        $pesanan->transform(function ($item) {
            // ambil semua produk yg punya kode_pesanan yg sama
            $produk_detail = DB::table('pesanan')
                ->join('produk', 'pesanan.kode_produk', '=', 'produk.kode_produk')
                ->where('pesanan.kode_pesanan', $item->kode_pesanan)
                ->select('produk.nama_produk', 'produk.kode_produk', 'pesanan.jumlah')
                ->get();

            $item->produk_detail = $produk_detail;
            return $item;
        });

        return view('pesanan.index', compact('produk', 'pembeli', 'pesanan'));
    }

    /**
     * Show the form for creating a new resource
     */
    public function show(string $kode)
    {
        $items = Pesanan::where('kode_pesanan', $kode)
            ->join('produk', 'pesanan.kode_produk', '=', 'produk.kode_produk')
            ->select(
                'produk.nama_produk',
                'produk.harga_Satuan',
                'pesanan.jumlah',
                'pesanan.nominal'
            )
            ->get();

        $pesanan = Pesanan::where('kode_pesanan', $kode)->firstOrFail();
        $pembeli = Pembeli::find($pesanan->id_pembeli);

        $totalKeseluruhan = $items->sum('nominal');

        return view('pesanan.modal.detail', compact('pesanan', 'pembeli', 'items', 'totalKeseluruhan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $status = $request->status;
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
        $produk_ids = $request->input('produk', []);
        $jumlah     = $request->input('jumlah', []);

        $kodePesanan = 'PESN-' . date('dm') . '-' . date('Hi') . '-' . Str::upper(Str::random(3));

        foreach ($produk_ids as $index => $idProduk) {
            $produk = Produk::find($idProduk);
            if (!$produk) continue;

            $qty = $jumlah[$index] ?? 1;
            $subtotal = $produk->harga_Satuan * $qty;

            Pesanan::create([
                'kode_pesanan' => $kodePesanan,
                'id_pembeli'   => $request->id_pembeli,
                'user_id'      => 1,
                'status'       => 'baru',
                'kode_produk'  => $produk->kode_produk, // ⬅ simpan per baris
                'jumlah'       => $qty,
                'nominal'      => $subtotal,            // ⬅ subtotal per produk
            ]);
        }

        return redirect()->route('pesanan.index');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $kode_pesanan)
    {
        $request->validate([
            'id_pembeli' => 'required|exists:pembeli,id_pembeli',
            'produk'     => 'required|array',
            'jumlah'     => 'required|array',
            'nominal'    => 'required|numeric',
        ]);

        DB::table('pesanan')->where('kode_pesanan', $kode_pesanan)->delete();

        foreach ($request->produk as $i => $kodeProduk) {
            $produk = DB::table('produk')->where('kode_produk', $kodeProduk)->first();
            if (!$produk) continue;

            $qty = $request->jumlah[$i] ?? 1;
            $subtotal = $produk->harga_Satuan * $qty;

            DB::table('pesanan')->insert([
                'kode_pesanan' => $kode_pesanan,
                'id_pembeli'   => $request->id_pembeli,
                'user_id'      => 1,
                'status'       => 'baru',
                'kode_produk'  => $kodeProduk,
                'jumlah'       => $qty,
                'nominal'      => $subtotal,
                'updated_at'   => now(),
                'created_at'   => now(),
            ]);
        }

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diupdate!');
    }

    public function destroy($id)
    {
        Pesanan::where('kode_pesanan', $id)->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
    }
}
