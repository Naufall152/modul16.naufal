<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Pastikan file `auth/login.blade.php` ada
    }
    // Fungsi logout
    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna
        $request->session()->invalidate(); // Invalidasi sesi
        $request->session()->regenerateToken(); // Regenerasi token CSRF

        return redirect()->route('login'); // Kembali ke halaman login
    }
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial
        if (Auth::attempt($request->only('email', 'password'))) {
            // Jika berhasil login, regenerasi sesi dan arahkan ke home
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        // Jika gagal login, kembali ke login dengan pesan error
        return back()->withErrors([
            'loginError' => 'Invalid email or password.',
        ])->withInput();
    }
}
