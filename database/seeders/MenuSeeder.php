<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID dari masing-masing kategori
        $idPanas = Kategori::where('nama_kategori', 'Minuman Panas')->first()->id ?? 1;
        $idDingin = Kategori::where('nama_kategori', 'Minuman Dingin')->first()->id ?? 2;
        $idGoreng = Kategori::where('nama_kategori', 'Camilan Goreng')->first()->id ?? 3;
        $idMakanan = Kategori::where('nama_kategori', 'Makanan Utama')->first()->id ?? 4;
        $idTradisional = Kategori::where('nama_kategori', 'Minuman Tradisional')->first()->id ?? 5;

        $menus = [
            // Minuman Panas
            ['kategori_id' => $idPanas, 'nama' => 'Kopi Hitam Tubruk', 'hpp' => 2000, 'harga' => 5000],
            ['kategori_id' => $idPanas, 'nama' => 'Kopi Susu Hangat', 'hpp' => 3500, 'harga' => 7000],
            ['kategori_id' => $idPanas, 'nama' => 'Cappuccino Panas', 'hpp' => 6000, 'harga' => 12000],
            ['kategori_id' => $idPanas, 'nama' => 'Teh Manis Hangat', 'hpp' => 1500, 'harga' => 4000],
            ['kategori_id' => $idPanas, 'nama' => 'Kopi Tarik', 'hpp' => 5000, 'harga' => 10000],

            // Minuman Dingin
            ['kategori_id' => $idDingin, 'nama' => 'Es Kopi Susu Gula Aren', 'hpp' => 7500, 'harga' => 15000],
            ['kategori_id' => $idDingin, 'nama' => 'Es Teh Manis', 'hpp' => 2000, 'harga' => 5000],
            ['kategori_id' => $idDingin, 'nama' => 'Es Jeruk Peras', 'hpp' => 3500, 'harga' => 7000],
            ['kategori_id' => $idDingin, 'nama' => 'Es Matcha Latte', 'hpp' => 9000, 'harga' => 18000],
            ['kategori_id' => $idDingin, 'nama' => 'Es Milo Dinosaurus', 'hpp' => 6000, 'harga' => 12000],

            // Camilan Goreng
            ['kategori_id' => $idGoreng, 'nama' => 'Pisang Goreng Keju', 'hpp' => 5000, 'harga' => 10000],
            ['kategori_id' => $idGoreng, 'nama' => 'Mendoan Anget', 'hpp' => 4000, 'harga' => 8000],
            ['kategori_id' => $idGoreng, 'nama' => 'Kentang Goreng', 'hpp' => 6000, 'harga' => 12000],
            ['kategori_id' => $idGoreng, 'nama' => 'Tahu Isi Pedas', 'hpp' => 4000, 'harga' => 8000],
            ['kategori_id' => $idGoreng, 'nama' => 'Singkong Keju Meledak', 'hpp' => 6000, 'harga' => 12000],

            // Makanan Utama
            ['kategori_id' => $idMakanan, 'nama' => 'Mie Instan Telur 2 Sawi', 'hpp' => 7000, 'harga' => 14000],
            ['kategori_id' => $idMakanan, 'nama' => 'Nasi Goreng Gila', 'hpp' => 9000, 'harga' => 18000],
            ['kategori_id' => $idMakanan, 'nama' => 'Mie Goreng Spesial', 'hpp' => 7500, 'harga' => 15000],
            ['kategori_id' => $idMakanan, 'nama' => 'Ayam Geprek Nasi Putih', 'hpp' => 12000, 'harga' => 20000],
            ['kategori_id' => $idMakanan, 'nama' => 'Nasi Telur Pontianak', 'hpp' => 6000, 'harga' => 12000],

            // Minuman Tradisional
            ['kategori_id' => $idTradisional, 'nama' => 'Wedang Jahe Rempah', 'hpp' => 4000, 'harga' => 8000],
            ['kategori_id' => $idTradisional, 'nama' => 'Susu Jahe Merah', 'hpp' => 5000, 'harga' => 10000],
            ['kategori_id' => $idTradisional, 'nama' => 'Bandrek', 'hpp' => 3500, 'harga' => 7000],
            ['kategori_id' => $idTradisional, 'nama' => 'STMJ (Susu Telur Madu Jahe)', 'hpp' => 8000, 'harga' => 15000],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
