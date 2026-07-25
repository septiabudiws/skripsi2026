<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi inputan form diubah ke email
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // 2. Coba login
        if (Auth::attempt($credentials)) {

            // 3. Cek status aktif
            if (Auth::user()->status !== 'aktif') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Akun Anda belum diaktifkan oleh Admin.', // Pesan error ke email
                ])->onlyInput('email'); // Kembalikan inputan email
            }

            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        // Jika email/password salah
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
