<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $penjualan = Pesanan::select(
        DB::raw('DATE(created_at) as tanggal'),
        DB::raw('SUM(nominal) as total_penjualan')
    )
        ->where('status', 'selesai')
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy('tanggal', 'asc')
        ->get()
        ->keyBy('tanggal'); 

    $pengeluaran = Pengeluaran::select(
        DB::raw('DATE(created_at) as tanggal'),
        DB::raw('SUM(nominal) as total_pengeluaran')
    )
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy('tanggal', 'asc')
        ->get()
        ->keyBy('tanggal');

    $allDates = collect($penjualan->keys())
        ->merge($pengeluaran->keys())
        ->unique()
        ->sort();

    $rekap = $allDates->map(function ($tanggal) use ($penjualan, $pengeluaran) {
        return [
            'tanggal' => $tanggal,
            'penjualan' => $penjualan[$tanggal]->total_penjualan ?? 0,
            'pengeluaran' => $pengeluaran[$tanggal]->total_pengeluaran ?? 0,
        ];
    });

    return view('rekap.index', compact('rekap'));
}


    /**
     * Show the form for creating a new resource.
     */
    // public function filter(Request $request)
    // {
    //     $tanggal = $request->input('tanggal');

    //     $penjualan = Pesanan::selectRaw('DATE(created_at) as tanggal, SUM(nominal) as total')
    //         ->where('status', 'selesai')
    //         ->when($tanggal, fn($q) => $q->whereDate('created_at', $tanggal))
    //         ->groupBy('tanggal')
    //         ->get();

    //     $pengeluaran = Pengeluaran::selectRaw('DATE(created_at) as tanggal, SUM(nominal) as nominal')
    //         ->whereDate('created_at', $tanggal)
    //         ->get();

    //     $rekap = $penjualan->zip($pengeluaran);

    //     return response()->json($rekap);
    // }


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
