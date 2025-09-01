<?php

namespace App\Http\Controllers;

<<<<<<< Updated upstream
=======
use App\Models\Pengeluaran;
>>>>>>> Stashed changes
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
<<<<<<< Updated upstream
        return view('pengeluaran.index');
=======
        $pengeluaran = Pengeluaran::all();
        return view('pengeluaran.index', compact('pengeluaran'));
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
        //
=======
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

        $pengeluaran->save();

        return back()->with('success', 'Pengeluaran Berhasil Disimpan');
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
        //
=======
        $pengeluaran = Pengeluaran::findOrFail($id);

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

        $pengeluaran->nama_pengeluaran = $request->nama_pengeluaran;
        $pengeluaran->tanggal = $request->tanggal;
        $pengeluaran->keterangan = $request->keterangan;
        $pengeluaran->nominal = $request->nominal;

        $pengeluaran->save();

        return back()->with('success', 'Data pengeluaran berhasil diperbarui');
>>>>>>> Stashed changes
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
