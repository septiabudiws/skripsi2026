<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\TransaksiModel;
use App\Models\Kategori;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use App\Services\ArasServices;

class DashboardCotroller extends Controller
{
    public function index(Request $request, ArasServices $arasService)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');
        $hariIni = Carbon::today();

        $hasilAras = $arasService->hitungPerankingan($bulan, $tahun);
        $namaMenuOptimal = isset($hasilAras[1]) ? $hasilAras[1]['nama_menu'] : 'Belum Ada Data';

        $totalMenu         = Menu::count();
        $totalKategori     = Kategori::count();
        $transaksiHariIni  = TransaksiModel::whereDate('created_at', $hariIni)->count();
        $pendapatanHariIni = TransaksiModel::whereDate('created_at', $hariIni)->sum('subtotal');

        $transaksiTerbaru  = TransaksiModel::whereDate('created_at', $hariIni)
                                ->latest()
                                ->take(3)
                                ->get();

        // =======================================================
        // 4. DATA DINAMIS TREN PENDAPATAN (OPTIMASI QUERY)
        // =======================================================
        $labelPendapatan = [];
        $dataPendapatan = [];

        // Ambil data 7 hari terakhir dalam 1x Query (Jauh lebih cepat dari sebelumnya)
        $tujuhHariLalu = Carbon::today()->subDays(6);
        $transaksiMingguan = TransaksiModel::whereDate('created_at', '>=', $tujuhHariLalu)
            ->selectRaw('DATE(created_at) as tanggal, SUM(subtotal) as total')
            ->groupBy('tanggal')
            ->pluck('total', 'tanggal');

        // Menyusun array untuk chart ApexCharts
        for ($i = 6; $i >= 0; $i--) {
            $tanggal = Carbon::today()->subDays($i);

            $labelPendapatan[] = $tanggal->translatedFormat('d M');
            // Masukkan nominal dari database, jika hari itu tidak ada transaksi, isi dengan 0
            $dataPendapatan[] = $transaksiMingguan[$tanggal->format('Y-m-d')] ?? 0;
        }

        // =======================================================
        // 5. DATA DINAMIS PROPORSI KATEGORI
        // =======================================================
        $labelKategori = [];
        $dataKategori = [];

        $kategoriPenjualan = DB::table('kategori')
            ->leftJoin('menu', 'kategori.id', '=', 'menu.kategori_id')
            ->leftJoin('detail_transaksi', 'menu.id', '=', 'detail_transaksi.menu_id')
            ->select('kategori.nama_kategori', DB::raw('COALESCE(SUM(detail_transaksi.qty), 0) as total_terjual'))
            ->groupBy('kategori.id', 'kategori.nama_kategori')
            ->havingRaw('total_terjual > 0')
            ->get();

        foreach ($kategoriPenjualan as $kp) {
            $labelKategori[] = $kp->nama_kategori;
            $dataKategori[]  = (int) $kp->total_terjual;
        }

        return view('dashboard', compact(
            'namaMenuOptimal',
            'totalMenu',
            'totalKategori',
            'transaksiHariIni',
            'pendapatanHariIni',
            'transaksiTerbaru',
            'labelPendapatan',
            'dataPendapatan',
            'labelKategori',
            'dataKategori'
        ));
    }
}
