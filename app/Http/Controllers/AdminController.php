<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = User::all();
        return view('admin.index', compact('admin'));
    }

    public function store(Request $request)
    {
        // Validasi dasar dulu
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:5',
        ]);

        $userada = User::where('email', $request->email)
            ->get()
            ->first(function ($user) use ($request) {
                return Hash::check($request->password, $user->password);
            });

        if ($userada) {
            return back()->withErrors(['msg' => 'Pengguna sudah terdaftar.']);
        }

        // if (User::where('nama', $request->nama)->exists()) {
        //     return back()->withErrors(['msg' => 'Pengguna sudah terdaftar.']);
        // }

        // if (User::where('email', $request->email)->exists()) {
        //     return back()->withErrors(['msg' => 'Email sudah terdaftar.']);
        // }

        // $existsEmailPassword = User::where('email', $request->email)
        //     ->get()
        //     ->first(function ($user) use ($request) {
        //         return Hash::check($request->password, $user->password);
        //     });

        // if ($existsEmailPassword) {
        //     return back()->withErrors(['msg' => 'Email + Password sudah terdaftar.']);
        // }

        $newUser = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $newUser->save();

        return back()->with('success', 'Pengguna Berhasil Disimpan');
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
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'nullable|string|min:5',
    ]);

    // cek email unik
    if (User::where('email', $request->email)
            ->where('id_user', '!=', $user->id_user)
            ->exists()) {
        return back()->withErrors(['msg' => 'Email sudah terdaftar.']);
    }

    $user->nama = $request->nama;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return back()->with('success', 'Data admin berhasil diperbarui');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('success', 'Admin Berhasil Dihapus');
    }
}
