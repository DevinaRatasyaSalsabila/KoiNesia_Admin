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
    public function show(string $id)
    {
        $pesanan = DB::table('pesanan')
            ->join('pembeli', 'pesanan.id_pembeli', '=', 'pembeli.id_pembeli')
            ->select('pesanan.*', 'pembeli.nama_pembeli', 'pembeli.no_hp', 'pembeli.alamat')
            ->where('pesanan.id_pesanan', $id)
            ->first();

        // decode kode_produk (pastikan memang disimpan JSON)
        $produk_ids = json_decode($pesanan->kode_produk, true);

        if ($produk_ids) {
            $produk = DB::table('produk')
                ->whereIn('kode_produk', $produk_ids)
                ->select('kode_produk', 'nama_produk', 'harga_Satuan')
                ->get();
        } else {
            $produk = collect();
        }

        return view('pesanan.modal.detail', compact('pesanan', 'produk'));
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
        // dd($request->all());
        // Ambil array produk_id dari form
        $produk_ids = $request->input('produk', []);
        $jumlah = $request->input('jumlah', []);

        // Ambil kode_produk dari tabel produk
        $kode_produk = Produk::whereIn('id_produk', $produk_ids)
            ->pluck('kode_produk') // ambil kode_produk
            ->toArray();

        // Total nominal
        $nominal = 0;
        foreach ($produk_ids as $index => $id) {
            $harga = Produk::find($id)->harga_Satuan ?? 0;
            $qty = $jumlah[$index] ?? 1;
            $nominal += $harga * $qty;
        }

        $pesanan = Pesanan::create([
            'id_pembeli' => $request->id_pembeli,
            'kode_produk' => json_encode($kode_produk), // simpan sebagai JSON
            'user_id' => '1',
            'status' => 'baru',
            'jumlah' => array_sum($jumlah),
            'nominal' => $nominal,
        ]);

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
        // Validasi
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
    public function destroy(string $id)
    {
        //
    }
}
