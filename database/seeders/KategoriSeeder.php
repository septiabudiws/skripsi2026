<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            'Minuman Dingin',
            'Minuman Panas',
            'Makanan Utama',
            'Camilan & Tambahan'
        ];

        foreach ($kategori as $item) {
            Kategori::create([
                'nama_kategori' => $item
            ]);
        }
    }
}
