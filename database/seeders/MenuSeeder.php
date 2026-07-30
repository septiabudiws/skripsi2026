<?php

namespace Database\Seeders;

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
        $menus = [
            ['kategori_id' => 1, 'nama' => 'Air Mineral', 'harga' => 3000, 'hpp' => 1800],
            ['kategori_id' => 1, 'nama' => 'Bimsu', 'harga' => 7000, 'hpp' => 3200],
            ['kategori_id' => 1, 'nama' => 'Es Kopi Susu', 'harga' => 10000, 'hpp' => 3200],
            ['kategori_id' => 1, 'nama' => 'Es Kopi Susu Aren', 'harga' => 12000, 'hpp' => 5000],
            ['kategori_id' => 1, 'nama' => 'Extra Joss', 'harga' => 5000, 'hpp' => 1900],
            ['kategori_id' => 1, 'nama' => 'Joshua', 'harga' => 7000, 'hpp' => 3200],
            ['kategori_id' => 1, 'nama' => 'Kuku Bima', 'harga' => 5000, 'hpp' => 1900],
            ['kategori_id' => 1, 'nama' => 'Matcha', 'harga' => 8000, 'hpp' => 4500],
            ['kategori_id' => 1, 'nama' => 'Milo', 'harga' => 8000, 'hpp' => 4500],
            ['kategori_id' => 1, 'nama' => 'Nutrisari', 'harga' => 5000, 'hpp' => 2000],
            ['kategori_id' => 1, 'nama' => 'Nutrisari Susu', 'harga' => 7000, 'hpp' => 3300],
            ['kategori_id' => 1, 'nama' => 'Taro', 'harga' => 8000, 'hpp' => 4500],

            ['kategori_id' => 2, 'nama' => 'Beng-Beng', 'harga' => 8000, 'hpp' => 4500],
            ['kategori_id' => 2, 'nama' => 'Giras', 'harga' => 7000, 'hpp' => 2000],
            ['kategori_id' => 2, 'nama' => 'Giras Susu', 'harga' => 8000, 'hpp' => 3300],
            ['kategori_id' => 2, 'nama' => 'Kopi Hitam', 'harga' => 6000, 'hpp' => 1700],
            ['kategori_id' => 2, 'nama' => 'Kopi Jahe', 'harga' => 6000, 'hpp' => 2400],
            ['kategori_id' => 2, 'nama' => 'Kopi Susu', 'harga' => 7000, 'hpp' => 2800],
            ['kategori_id' => 2, 'nama' => 'Susu', 'harga' => 5000, 'hpp' => 2000],
            ['kategori_id' => 2, 'nama' => 'Teh', 'harga' => 4000, 'hpp' => 1000],
            ['kategori_id' => 2, 'nama' => 'Teh Susu', 'harga' => 7000, 'hpp' => 2200],

            ['kategori_id' => 3, 'nama' => 'Indomie', 'harga' => 6000, 'hpp' => 4000],

            ['kategori_id' => 4, 'nama' => 'Telur Goreng', 'harga' => 3000, 'hpp' => 2500],
        ];

        foreach ($menus as $item) {
            Menu::create($item);
        }
    }
}
