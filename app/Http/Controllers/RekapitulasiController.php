<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiModel;
use App\Models\User;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class RekapitulasiController extends Controller
{
    public function index(Request $request)
    {
        $query = TransaksiModel::with(['user', 'metodePembayaran', 'detailTransaksi.menu']);

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $startDate = $request->start_date ?: Carbon::today()->format('Y-m-d');
        $endDate = $request->end_date ?: Carbon::today()->format('Y-m-d');

        $query->whereDate('created_at', '>=', $startDate)
              ->whereDate('created_at', '<=', $endDate);

        $transaksi = $query->latest()->get();

        $totalOmzet = $transaksi->sum('subtotal');

        $totalTunai = $transaksi->filter(function ($trx) {
            $metode = strtolower($trx->metodePembayaran->nama ?? $trx->metodePembayaran->nama_metode ?? '');
            return str_contains($metode, 'tunai') || str_contains($metode, 'cash');
        })->sum('subtotal');

        $totalTransfer = $transaksi->filter(function ($trx) {
            $metode = strtolower($trx->metodePembayaran->nama ?? $trx->metodePembayaran->nama_metode ?? '');
            return str_contains($metode, 'transfer');
        })->sum('subtotal');

        $totalQris = $transaksi->filter(function ($trx) {
            $metode = strtolower($trx->metodePembayaran->nama ?? $trx->metodePembayaran->nama_metode ?? '');
            return str_contains($metode, 'qris');
        })->sum('subtotal');

        $karyawans = User::all();

        return view('rekap.rekapitulasi', compact(
            'transaksi', 'totalOmzet', 'totalTunai', 'totalTransfer', 'totalQris', 'karyawans'
        ));
    }

    public function exportPdf(Request $request)
    {
        // 1. Ambil data dengan logika filter yang sama persis dengan fungsi index()
        $query = TransaksiModel::with(['user', 'metodePembayaran']);

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $startDate = $request->start_date ?: Carbon::today()->format('Y-m-d');
        $endDate = $request->end_date ?: Carbon::today()->format('Y-m-d');

        $query->whereDate('created_at', '>=', $startDate)
              ->whereDate('created_at', '<=', $endDate);

        $transaksi = $query->latest()->get();

        // 2. Kalkulasi Ringkasan Keuangan
        $totalOmzet = $transaksi->sum('subtotal');

        $totalTunai = $transaksi->filter(function ($trx) {
            $metode = strtolower($trx->metodePembayaran->nama ?? $trx->metodePembayaran->nama_metode ?? '');
            return str_contains($metode, 'tunai') || str_contains($metode, 'cash');
        })->sum('subtotal');

        $totalTransfer = $transaksi->filter(function ($trx) {
            $metode = strtolower($trx->metodePembayaran->nama ?? $trx->metodePembayaran->nama_metode ?? '');
            return str_contains($metode, 'transfer');
        })->sum('subtotal');

        $totalQris = $transaksi->filter(function ($trx) {
            $metode = strtolower($trx->metodePembayaran->nama ?? $trx->metodePembayaran->nama_metode ?? '');
            return str_contains($metode, 'qris');
        })->sum('subtotal');

        // Cari nama kasir jika di-filter, jika tidak tulis 'Semua Kasir'
        $namaKasir = 'Semua Kasir';
        if ($request->filled('user_id')) {
            $kasir = User::find($request->user_id);
            $namaKasir = $kasir->nama ?? $kasir->name ?? 'Semua Kasir';
        }

        // 3. Render ke PDF
        $pdf = Pdf::loadView('rekap.rekap_pdf', compact(
            'transaksi', 'totalOmzet', 'totalTunai', 'totalTransfer', 'totalQris', 'startDate', 'endDate', 'namaKasir'
        ));

        // Setting ukuran kertas A4 Portrait
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('Laporan-Penjualan-Warkop-' . date('Ymd-Hi') . '.pdf');
    }
}
