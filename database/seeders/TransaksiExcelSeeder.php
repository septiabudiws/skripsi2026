<?php

namespace Database\Seeders;

use App\Models\DetailTransaksi;
use App\Models\Menu;
use App\Models\TransaksiModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TransaksiExcelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Baca file CSV yang sudah ditaruh di folder database/seeders/
        $csvPath = database_path('seeders/data_penjualan.csv');

        if (!file_exists($csvPath)) {
            $this->command->error('File data_penjualan.csv tidak ditemukan di folder seeders!');
            return;
        }

        $csvFile = fopen($csvPath, "r");
        $isFirstLine = true;

        // 2. Looping per baris data CSV
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            // Lewati baris pertama (Header/Judul Kolom)
            if ($isFirstLine) {
                $isFirstLine = false;
                continue;
            }

            // Ambil data sesuai urutan kolom (Dimulai dari index 0)
            $idTransaksiExcel = $data[0]; // Kolom A: ID Transaksi
            $tanggalRaw       = trim($data[1]); // Kolom B: Tanggal Pembelian (Format: DD-MM-YYYY)
            $namaMenu         = trim($data[2]); // Kolom C: Menu
            $hargaSatuan      = $data[3]; // Kolom D: Harga Satuan
            $qty              = $data[4]; // Kolom E: Jumlah
            $subtotal         = $data[5]; // Kolom F: Subtotal

            // 3. Cari Menu ID berdasarkan Nama di database
            $menu = Menu::where('nama', $namaMenu)->first();

            if ($menu) {
                // 4. Cari atau Buat Transaksi Induk
                // Kita gunakan kode unik agar item dengan ID Excel yang sama masuk ke 1 struk yang sama
                $kodeTrx = 'TRX-OLD-' . str_pad($idTransaksiExcel, 4, '0', STR_PAD_LEFT);

                // Ubah format tanggal dari DD-MM-YYYY menjadi YYYY-MM-DD standar database
                $tanggalDatabase = Carbon::createFromFormat('d-m-Y', $tanggalRaw)->format('Y-m-d') . ' 12:00:00';

                $transaksi = TransaksiModel::firstOrCreate(
                    ['kode_transaksi' => $kodeTrx],
                    [
                        'user_id'              => 2, // Set ke User ID 1 (Admin/Kasir default)
                        'metode_pembayaran_id' => 1, // Set default 1 (Misal: Tunai)
                        'nama_customer'        => 'Pelanggan ' . $idTransaksiExcel,
                        'total_qty'            => 0, // Akan di-update otomatis di bawah
                        'subtotal'             => 0, // Akan di-update otomatis di bawah
                        'bayar'                => 0,
                        'kembalian'            => 0,
                        'created_at'           => $tanggalDatabase,
                        'updated_at'           => $tanggalDatabase,
                    ]
                );

                // 5. Masukkan ke Detail Transaksi
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'menu_id'      => $menu->id,
                    'qty'          => $qty,
                    'harga_satuan' => $hargaSatuan,
                    'subtotal'     => $subtotal,
                ]);

                // 6. Update Total di Transaksi Induk secara akumulatif
                $transaksi->total_qty += $qty;
                $transaksi->subtotal  += $subtotal;
                $transaksi->bayar      = $transaksi->subtotal; // Asumsi pelanggan bayar pas
                $transaksi->save();
            } else {
                // Beri peringatan di terminal jika ada menu di Excel yang tidak cocok dengan di database
                $this->command->warn("Menu tidak ditemukan di database: " . $namaMenu);
            }
        }

        fclose($csvFile);
        $this->command->info('Data penjualan dari CSV berhasil dimasukkan!');
    }
}
