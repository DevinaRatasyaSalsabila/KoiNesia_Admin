<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use App\Models\Pengaturan;
use App\Models\Pengeluaran;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DasboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaturan = Pengaturan::first();
        $produk = Produk::all();
        $pesanan = Pesanan::all();
        $pesananSelesai = Pesanan::where('status', 'selesai')->sum('jumlah');
        // dd($pesananSelesai);
        $PesanBaru = Pesanan::select('kode_pesanan', DB::raw('MAX(created_at) as created_at'))
            ->groupBy('kode_pesanan')
            ->orderByDesc('created_at')
            ->take(5)
            ->pluck('kode_pesanan');

        $pesananNew = Pesanan::select(
            'kode_pesanan',
            DB::raw('SUM(jumlah) as total_barang'),
            DB::raw('SUM(nominal) as total_nominal'),
            DB::raw('MAX(created_at) as created_at')
        )
            ->whereIn('kode_pesanan', $PesanBaru)
            ->groupBy('kode_pesanan')
            ->orderByDesc('created_at')
            ->get();

        foreach ($pesananNew as $item) {
            $produkRandom = Pesanan::where('kode_pesanan', $item->kode_pesanan)
                ->inRandomOrder()
                ->first();

            if ($produkRandom) {
                $gambarProduk = Produk::where('kode_produk', $produkRandom->kode_produk)->value('gambar_produk');

                if ($gambarProduk) {
                    $gambarArray = json_decode($gambarProduk, true);

                    if (is_array($gambarArray) && count($gambarArray) > 0) {
                        $item->gambar = $gambarArray[array_rand($gambarArray)];
                    } else {
                        $item->gambar = null;
                    }
                } else {
                    $item->gambar = null;
                }
            } else {
                $item->gambar = null;
            }
        }

        $penjualanBulanan = Pesanan::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('SUM(nominal) as total')
        )
            ->where('status', 'selesai')
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'bulan');

        $penjualanData = [];
        for ($i = 1; $i <= 12; $i++) {
            $penjualanData[] = $penjualanBulanan->get($i, 0);
        }

        $PengeluaranBulanan = Pengeluaran::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('SUM(nominal) as total')
        )
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'bulan');

        $PengeluaranData = [];
        for ($i = 1; $i <= 12; $i++) {
            $PengeluaranData[] = $PengeluaranBulanan->get($i, 0);
        }

        $pendapatanPerBulan = Pesanan::where('status', 'selesai')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('nominal');


        return view('dashboard.index', compact('produk', 'pesanan', 'pesananSelesai', 'pesananNew', 'penjualanData', 'PengeluaranData', 'pendapatanPerBulan', 'pengaturan'));
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
    public function show(string $id)
    {
        //
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
