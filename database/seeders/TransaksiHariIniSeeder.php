<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransaksiModel;
use App\Models\Menu;
use App\Models\DetailTransaksi;
use Carbon\Carbon;

class TransaksiHariIniSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua data menu yang ada di database untuk diacak nanti
        $semuaMenu = Menu::all();

        // Jika belum ada menu sama sekali, hentikan seeder agar tidak error
        if ($semuaMenu->isEmpty()) {
            $this->command->error('Tabel menu masih kosong! Silakan isi menu terlebih dahulu.');
            return;
        }

        $jumlahTransaksi = 100;
        $waktuSekarang = Carbon::now();

        for ($i = 0; $i < $jumlahTransaksi; $i++) {

            // --- TAHAP 1: SIMULASI KERANJANG BELANJA (DETAIL TRANSAKSI) ---
            $jumlahMacamMenu = rand(1, 4); // Pembeli beli 1 sampai 4 macam menu berbeda
            $keranjang = $semuaMenu->random($jumlahMacamMenu);

            $subtotal = 0;
            $total_qty = 0;
            $dataDetail = [];

            foreach ($keranjang as $menu) {
                $qtyBeli = rand(1, 3);
                $total_qty += $qtyBeli;

                // Hitung subtotal khusus untuk baris menu ini saja (harga * qty)
                $subtotal_per_item = $menu->harga * $qtyBeli;

                // Tambahkan ke subtotal keseluruhan nota/transaksi
                $subtotal += $subtotal_per_item;

                // Simpan sementara di array
                $dataDetail[] = [
                    'menu_id'      => $menu->id,
                    'qty'          => $qtyBeli,
                    'harga_satuan' => $menu->harga,
                    'subtotal'     => $subtotal_per_item, // <-- Tambahkan baris ini
                ];
            }

            // --- TAHAP 2: LOGIKA PEMBAYARAN ---
            $peluangMetode = rand(1, 10);
            $metode_id = ($peluangMetode <= 6) ? 1 : (($peluangMetode <= 8) ? 2 : 3); // 1=Tunai, 2=QRIS, 3=Transfer

            $bayar = 0;
            $kembali = 0;

            if ($metode_id == 1) { // Cash
                $pecahanUang = [50000, 100000];
                if ($subtotal >= 100000) {
                    $pecahanUang = [100000, 150000, 200000, 300000];
                }
                do {
                    $bayar = $pecahanUang[array_rand($pecahanUang)];
                } while ($bayar <= $subtotal);

                $kembali = $bayar - $subtotal;
            } else { // QRIS / Transfer
                $bayar = $subtotal;
                $kembali = 0;
            }

            $waktuTransaksi = Carbon::today()->setTime(rand(0, 23), rand(0, 59));

            // --- TAHAP 3: SIMPAN KE TABEL TRANSAKSI (INDUK) ---
            $transaksiBaru = TransaksiModel::create([
                'kode_transaksi' => 'TRX-' . $waktuTransaksi->format('Ymd') . '-' . rand(100, 999) . '-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'user_id'              => 1,
                'metode_pembayaran_id' => $metode_id,
                'total_qty'            => $total_qty,
                'subtotal'             => $subtotal,
                'bayar'                => $bayar,
                'kembalian'            => $kembali,
                'created_at'           => $waktuTransaksi,
                'updated_at'           => $waktuTransaksi,
            ]);

            // --- TAHAP 4: SIMPAN KE TABEL DETAIL TRANSAKSI (ANAK) ---
            foreach ($dataDetail as $detail) {
                DetailTransaksi::create([
                    'transaksi_id' => $transaksiBaru->id,
                    'menu_id'      => $detail['menu_id'],
                    'qty'          => $detail['qty'],
                    'harga_satuan' => $detail['harga_satuan'],
                    'subtotal'     => $detail['subtotal'], // <-- Tambahkan baris ini
                    'created_at'   => $waktuTransaksi,
                    'updated_at'   => $waktuTransaksi,
                ]);
            }
        }
    }
}
