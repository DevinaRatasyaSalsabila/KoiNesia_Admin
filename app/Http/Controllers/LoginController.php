<?php






namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:90',
            'password' => 'required|min:5'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::guard('web')->login($user);
            return redirect()->route('dashboard')->with('success', 'Login berhasil');
        }

        return back()->withErrors([
            'login_error' => 'Email atau password salah, silahkan periksa kembali.'
        ]);
    }

    public function logout(Request $request)
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
            return redirect()->route('login')->with('success', 'Berhasil logout!');
        }

        if (Auth::guard('pembeli')->check()) {
            Auth::guard('pembeli')->logout();
            return redirect()->route('login.buyer')->with('success', 'Berhasil logout!');
        }

        return redirect()->route('login');
    }
}
