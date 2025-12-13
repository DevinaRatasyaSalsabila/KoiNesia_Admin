<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class MiddlewareLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        $route = $request->route()->getName();

        $belumLogin = [
            'dashboard.pelanggan',
            'login',
            'login.submit',
            'registrasi.buyer',
            'registrasi.submit',
            'login.buyer',
            'login.submit.buyer',
        ];

        $pembeliRoute = [
            'dashboard.pelanggan',
            'keranjang',
            'format',
            'pesanan.kirim',
            'logout',
        ];

        $logged = [
            'login',
            'login.submit',
            'registrasi.buyer',
            'registrasi.submit',
            'login.buyer',
            'login.submit.buyer',
        ];

        // Belum login sama sekali
        if (!Auth::guard('web')->check() && !Auth::guard('pembeli')->check()) {
            if (!in_array($route, $belumLogin)) {
                return redirect()->route('dashboard.pelanggan');
            }

            return $next($request);
        }

        // login sebagai pembeli
        if (Auth::guard('pembeli')->check()) {

            if (in_array($route, $logged)) {
                return redirect()->route('dashboard.pelanggan');
            }
            if (!in_array($route, $pembeliRoute)) {
                return redirect()->route('dashboard.pelanggan');
            }

            return $next($request);
        }

        // login sebagai admin
        if (Auth::guard('web')->check()) {
            if (in_array($route, $logged)) {
                return redirect()
                    ->route('dashboard')
                    ->with('error', 'Anda telah login sebagai admin.');
            }

            return $next($request);
        }

        return $next($request);
    }
}
