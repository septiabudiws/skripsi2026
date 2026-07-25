<?php

namespace App\Http\Controllers;

use App\Http\Requests\MetodePembayaranRequest;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;

class MetodePembayaranController extends Controller
{
    public function index()
    {
        $metode = MetodePembayaran::all();

        return view('metode_pembayaran.metode', compact('metode'));
    }

    public function create()
    {
        return view('metode_pembayaran.metode-create');
    }

    public function toggleStatus($id)
    {
        $metode = MetodePembayaran::findOrFail($id);
        $metode->is_active = !$metode->is_active;
        $metode->save();

        return redirect()->back()->with('success', 'Status diubah!');
    }

    public function store(MetodePembayaranRequest $request)
    {
        MetodePembayaran::create([
            'nama_metode' => $request->metode,
        ]);

        return redirect()->route('metode')->with('success', 'Metode pembayaran berhasil ditambahkan!');
    }

    public function edit(MetodePembayaran $metode)
    {
        return view('metode_pembayaran.metode-update', compact('metode'));
    }

    public function update(MetodePembayaranRequest $request, MetodePembayaran $metode)
    {
        $metode->update([
            'nama_metode' => $request->metode,
        ]);

        return redirect()->route('metode')->with('success', 'Metode pembayaran berhasil diperbarui!');
    }

    public function destroy(MetodePembayaran $metode)
    {
        $metode->delete();

        return redirect()->route('metode')->with('success', 'Metode pembayaran berhasil dihapus!');
    }
}
