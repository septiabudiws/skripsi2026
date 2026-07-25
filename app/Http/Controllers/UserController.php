<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
