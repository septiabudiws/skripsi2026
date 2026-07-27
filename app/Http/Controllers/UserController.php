<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $karyawan = User::all();
        return view('karyawan.karyawan', compact('karyawan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $karyawan = User::findOrFail($id);

        if ($request->has('status')) {
            $karyawan->status = 'aktif';
        } else {
            $karyawan->status = 'nonaktif';
        }

        $karyawan->save();

        return redirect()->back()->with('success', 'Status karyawan berhasil diubah!');
    }

    public function updatePermissions(Request $request, $id)
    {
        $karyawan = User::findOrFail($id);

        $permissions = $request->permissions ?? [];

        $karyawan->syncPermissions($permissions);

        return redirect()->back()->with('success', 'Hak akses karyawan berhasil diperbarui!');
    }

    public function changePassword(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Update password di database
        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();

        // 3. LOGOUT OTOMATIS
        Auth::logout(); // Mengeluarkan user dari sistem

        // Menghapus session lama untuk keamanan tambahan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 4. Redirect ke halaman Login
        return redirect()->route('login')->with('success', 'Password berhasil diubah! Silakan login kembali menggunakan password baru Anda.');
    }
}
