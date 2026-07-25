<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Menu;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        $menu = Menu::with('kategori')->get();
        $metodePembayaran = MetodePembayaran::where('is_active', true)->get();

        return view('transaksi.pos', compact('kategori', 'menu', 'metodePembayaran'));
    }
}
