<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengeluaran = Pengeluaran::all();
        return view('pengeluaran.index', compact('pengeluaran'));
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
        $request->validate([
            'nama_pengeluaran' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'nominal' => 'required|numeric',
        ]);

        $pengeluaranada = Pengeluaran::where('nama_pengeluaran', $request->nama_pengeluaran)
            ->where('tanggal', $request->tanggal)
            ->where('keterangan', $request->keterangan)
            ->where('nominal', $request->nominal)
            ->exists();

        if ($pengeluaranada) {
            return back()->withErrors(['msg' => 'Pengeluaran sudah tersimpan.']);
        }

        $pengeluaran = Pengeluaran::create([
            'nama_pengeluaran' => $request->nama_pengeluaran,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'nominal' => $request->nominal,
        ]);
        // dd($pengeluaran);
        $pengeluaran->save();

        return back()->with('success', 'Pengeluaran Berhasil Disimpan');
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
        $pengeluaran = Pengeluaran::findOrFail($id);

        $request->merge([
            'nominal' => preg_replace('/[^0-9]/', '', $request->nominal),
        ]);

        $request->validate([
            'nama_pengeluaran' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'nominal' => 'required|numeric',
        ]);

        $duplikat = Pengeluaran::where('nama_pengeluaran', $request->nama_pengeluaran)
            ->where('tanggal', $request->tanggal)
            ->where('keterangan', $request->keterangan)
            ->where('nominal', $request->nominal)
            ->where('id', '!=', $id)
            ->exists();

        if ($duplikat) {
            return back()->withErrors(['duplicate' => 'Data pengeluaran dengan kombinasi tersebut sudah ada.']);
        }

        $pengeluaran->update($request->all());

        return back()->with('success', 'Data pengeluaran berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        Pengeluaran::find($id)->delete();
        return redirect()->back()->with('success', 'Pengeluaran Berhasil Dihapus');
    }
}
