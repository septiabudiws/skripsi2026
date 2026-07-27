<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function register(){

        return view('auth.register');
    }

    public function registerStore(RegisterRequest $request){

    $user = User::create([
        'name'     => $request->name,
        'username' => $request->username,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $user->assignRole('karyawan');

    return redirect()->route('login')->with('success', 'Registrasi berhasil! Akun Anda sedang berstatus nonaktif.');
}
}
