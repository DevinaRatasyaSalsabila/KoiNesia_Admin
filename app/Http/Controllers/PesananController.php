<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PesananController extends Controller
{
    public function index()
    {
        $pembeli = Pembeli::all();
        $produk = DB::table('produk')->get();

        $pesanan = DB::table('pesanan')
            ->join('pembeli', 'pesanan.id_pembeli', '=', 'pembeli.id_pembeli')
            ->select('pesanan.*', 'pembeli.nama_pembeli', 'pembeli.no_hp', 'pembeli.alamat')
            ->get();

        $pesanan->transform(function ($item) {
            $produk_ids = json_decode($item->kode_produk, true);
            $jumlahs = json_decode($item->jumlah, true);

            $produk_detail = collect();
            if ($produk_ids) {
                foreach ($produk_ids as $i => $kode) {
                    $p = DB::table('produk')->where('kode_produk', $kode)->first();
                    if ($p) {
                        $p->jumlah = $jumlahs[$i] ?? 1;
                        $produk_detail->push($p);
                    }
                }
            }

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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_pembeli' => 'required|exists:pembeli,id_pembeli',
            'produk'     => 'required|array',
            'jumlah'     => 'required|array',
            'nominal'    => 'required|numeric',
        ]);

        // Simpan kode_produk & jumlah dalam bentuk JSON
        $produkData = [];
        foreach ($request->produk as $i => $kode) {
            $produkData[] = [
                'kode_produk' => $kode,
                'jumlah'      => $request->jumlah[$i] ?? 1,
            ];
        }

        DB::table('pesanan')
            ->where('id_pesanan', $id)
            ->update([
                'id_pembeli'  => $request->id_pembeli,
                'kode_produk' => json_encode(array_column($produkData, 'kode_produk')), // simpan kode_produk aja
                'jumlah'      => json_encode(array_column($produkData, 'jumlah')),     // simpan jumlah sesuai urutan
                'nominal'     => $request->nominal,
                'updated_at'  => now(),
            ]);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
    }
}
