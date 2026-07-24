<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Models\Kategori;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(){
        $menus = Menu::with('kategori')->get()->map(function ($item) {
                if ($item->harga > 0) {
                    $item->margin_profit = ($item->harga - $item->hpp) / $item->harga;
                } else {
                    $item->margin_profit = 0;
                }

                return $item;
            });

        $data = [
            'menu' => $menus,
        ];

        return view('menu.menu', $data);
    }

    public function create(){
        $kategori = Kategori::all();

        return view('menu.menu-create', compact('kategori'));
    }

    public function store(MenuRequest $request){
        Menu::create([
            'kategori_id' => $request->kategori_id,
            'nama' => $request->nama_menu,
            'hpp' => $request->hpp,
            'harga' => $request->harga,
        ]);

        return redirect()->route('menu')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit(Menu $menu){

        $kategori = Kategori::all();

        return view('menu.menu-update', compact('menu', 'kategori'));
    }

    public function update(MenuRequest $request, Menu $menu){

        $menu->update([
            'kategori_id' => $request->kategori_id,
            'nama' => $request->nama_menu,
            'hpp' => $request->hpp,
            'harga' => $request->harga,
        ]);

        return redirect()->route('menu')->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy(Menu $menu){
        
        $menu->delete();

        return redirect()->route('menu')->with('success', 'Menu berhasil dihapus!');
    }
}
