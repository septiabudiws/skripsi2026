<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ArasServices;

class RankingController extends Controller
{
    public function index(Request $request, ArasServices $arasService){
        $bulanIndo = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
            '04' => 'April', '05' => 'Mei', '06' => 'Juni',
            '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
            '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];

        $tahunSekarang = date('Y');

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $hasilAras = $arasService->hitungPerankingan($bulan, $tahun);

        return view('ranking.ranking', compact('bulanIndo', 'tahunSekarang', 'hasilAras', 'bulan', 'tahun'));
    }
}
