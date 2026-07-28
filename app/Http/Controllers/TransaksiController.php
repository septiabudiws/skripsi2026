<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Menu;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;
use App\Models\TransaksiModel;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TransaksiRequest;

class TransaksiController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        $menu = Menu::with('kategori')->get();
        $metodePembayaran = MetodePembayaran::where('is_active', true)->get();

        return view('transaksi.pos', compact('kategori', 'menu', 'metodePembayaran'));
    }

    public function store(TransaksiRequest $request)
    {
        DB::beginTransaction();
        try {
            // Generate kode struk otomatis
            $kodeTransaksi = 'TRX-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5));

            // Simpan tabel induk
            $transaksi = TransaksiModel::create([
                'kode_transaksi' => $kodeTransaksi,
                'user_id' => Auth::id(),
                'metode_pembayaran_id' => $request->metode_pembayaran_id,
                'nama_customer' => $request->nama_customer ?? 'Umum',
                'total_qty' => $request->total_qty,
                'subtotal' => $request->subtotal,
                'bayar' => $request->bayar,
                'kembalian' => $request->kembalian,
            ]);

            // Simpan tabel detail (looping keranjang)
            foreach ($request->cart as $item) {
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'menu_id' => $item['menu_id'],
                    'qty' => $item['qty'],
                    'harga_satuan' => $item['harga_satuan'],
                    'subtotal' => $item['subtotal'],
                ]);
            }

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Transaksi berhasil disimpan!',
                'kode' => $kodeTransaksi,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan server: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function hariIni()
    {
        $transaksi = TransaksiModel::with(['user', 'metodePembayaran', 'detailTransaksi.menu'])
            ->whereDate('created_at', today())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('transaksi.transaksi-hari-ini', compact('transaksi'));
    }
}
