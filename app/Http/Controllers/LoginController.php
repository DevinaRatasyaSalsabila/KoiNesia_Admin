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
        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'Login berhasil');
    }

    return back()->withErrors([
        'login_error' => 'Email atau password salah, silahkan periksa kembali.'
    ]);
}

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout berhasil');
    }
}
