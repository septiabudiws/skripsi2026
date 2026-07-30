<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index(Request $request)
{
    $bulanIndo = [
        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
        '04' => 'April', '05' => 'Mei', '06' => 'Juni',
        '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
        '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
    ];

    $tahunSekarang = date('Y');

    // Nanti logika perhitungan ARAS juga akan kita masukkan di sini...

    return view('ranking.ranking', compact('bulanIndo', 'tahunSekarang'));
}
}
