<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    // menampilkan halaman pengaturan
    public function index()
    {
        $pengaturan = Pengaturan::first();
        return view('pengaturan.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nomor_admin' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $pengaturan = Pengaturan::firstOrNew();
        $pengaturan->nomor_admin = $request->nomor_admin;

        if ($request->hasFile('gambar')) {
            $pengaturan->gambar = $request->file('gambar')
                                           ->store('pengaturan', 'public');
        }

        $pengaturan->save();

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui');
    }
}
