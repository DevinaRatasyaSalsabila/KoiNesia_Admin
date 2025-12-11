<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function index()
    {
        return view('pelanggan.auth.registrasi');
    }

    public function regisSubmit(Request $request)
    {
        Pembeli::create([
            'nama_pembeli'   => $request->nama,
            'email'  => $request->email,
            'no_hp'    => '+62' . $request->no_hp,
        ]);

        return view('pelanggan.auth.login')->with('success', 'Akun berhasil didaftarkan! Silahkan login dengan akun tersebut');
    }

    public function login()
    {
        return view('pelanggan.auth.login');
    }

    public function loginSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'no_hp' => 'required',
        ]);

        $pembeli = Pembeli::where('email', $request->email)
            ->orWhere('no_hp', '+62' . $request->no_hp)
            ->first();

        if ($pembeli) {
            Auth::guard('pembeli')->login($pembeli);
            return redirect()->route('dashboard.pelanggan');
        }

        return back()->withErrors(['email_or_hp' => 'Email atau No HP salah']);
    }
}
