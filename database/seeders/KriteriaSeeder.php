<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $kriteria = [
            [
                'kode_kriteria' => 'C1',
                'nama_kriteria' => 'Profit',
                'bobot_kriteria'         => 0.50,
                'tipe_kriteria'         => 'benefit'
            ],
            [
                'kode_kriteria' => 'C2',
                'nama_kriteria' => 'Margin Profit',
                'bobot_kriteria'         => 0.30,
                'tipe_kriteria'         => 'benefit'
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_kriteria' => 'Kuantitas',
                'bobot_kriteria'         => 0.10,
                'tipe_kriteria'         => 'benefit'
            ],
            [
                'kode_kriteria' => 'C4',
                'nama_kriteria' => 'Harga',
                'bobot_kriteria'         => 0.10,
                'tipe_kriteria'         => 'cost'
            ],
        ];

        foreach ($kriteria as $item) {
            Kriteria::create($item);
        }
    }
}
