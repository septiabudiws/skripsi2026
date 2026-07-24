<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriRequest;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $data = [
            'kategori' => Kategori::withCount('menu')->get()
        ];

        return view('kategori.kategori', $data);
    }

    public function create()
    {
        return view('kategori.kategori-create');
    }

    public function store(KategoriRequest $request)
    {
        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Kategori $kategori)
    {
        $data = [
            'kategori' => $kategori
        ];

        return view('kategori.kategori-update', $data);
    }

    public function update(KategoriRequest $request, Kategori $kategori)
    {
        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('kategori')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori')->with('success', 'Kategori berhasil dihapus!');
    }
}
