<?php

namespace Database\Seeders;

use App\Models\MetodePembayaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetodePembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $metode = [
            [
                'nama_metode' => 'Tunai',
                'is_active' => true,
            ],
            [
                'nama_metode' => 'QRIS',
                'is_active' => true,
            ],
            [
                'nama_metode' => 'Transfer',
                'is_active' => true,
            ],
        ];

        foreach ($metode as $item) {
            MetodePembayaran::create($item);
        }
    }
}
