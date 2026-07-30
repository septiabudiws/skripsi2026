<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\DetailTransaksi;
use App\Models\Kriteria;

class ArasServices
{
    /**
     * FUNCTION UTAMA (MANDOR)
     */
    public function hitungPerankingan($bulan, $tahun)
    {
        $kriteria = Kriteria::all();

        // Step 1: Matriks Keputusan Awal
        $matriksKeputusan = $this->step1_MatriksKeputusan($bulan, $tahun);

        if (empty($matriksKeputusan)) {
            return null;
        }

        // Step 2: Menentukan Nilai Optimum (A0)
        $matriksDenganA0 = $this->step2_NilaiOptimum($matriksKeputusan);

        // Step 3: Normalisasi Matriks (R)
        $matriksNormalisasi = $this->step3_Normalisasi($matriksDenganA0);

        // Step 4: Normalisasi Terbobot (V)
        $matriksTerbobot = $this->step4_NormalisasiTerbobot($matriksNormalisasi, $kriteria);

        // Step 5: Nilai S, K, dan Perankingan
        $hasilAkhir = $this->step5_Perankingan($matriksTerbobot);

        return [
            'step1' => $matriksKeputusan,
            'step2' => $matriksDenganA0,
            'step3' => $matriksNormalisasi,
            'step4' => $matriksTerbobot,
            'step5' => $hasilAkhir
        ];
    }

    // =========================================================================
    // PRIVATE FUNCTION TIAP STEP
    // =========================================================================

    private function step1_MatriksKeputusan($bulan, $tahun)
    {
        $menus = Menu::all();
        $matriks = [];

        foreach ($menus as $menu) {
            $totalTerjual = DetailTransaksi::where('menu_id', $menu->id)
                ->whereHas('transaksi', function($query) use ($bulan, $tahun) {
                    // Jika bulan & tahun dipilih, lakukan filter. Jika tidak, ambil semua.
                    if ($bulan && $tahun) {
                        $query->whereMonth('created_at', $bulan)
                              ->whereYear('created_at', $tahun);
                    }
                })->sum('qty');

            // Jika menu tidak terjual sama sekali bulan ini, bisa dilewati atau diset 0
            // Kita set 0 agar tetap masuk perhitungan (opsional, tergantung dosen pembimbing)

            $c1 = ($menu->harga - $menu->hpp) * $totalTerjual;
            $c2 = $menu->harga > 0 ? (($menu->harga - $menu->hpp) / $menu->harga) : 0;
            $c3 = $totalTerjual;
            $c4 = $menu->harga;

            $matriks[] = [
                'menu_id'   => $menu->id,
                'nama_menu' => $menu->nama,
                'C1'        => $c1,
                'C2'        => $c2,
                'C3'        => $c3,
                'C4'        => $c4,
            ];
        }

        return $matriks;
    }

    private function step2_NilaiOptimum($matriksKeputusan)
    {
        $c1_values = array_column($matriksKeputusan, 'C1');
        $c2_values = array_column($matriksKeputusan, 'C2');
        $c3_values = array_column($matriksKeputusan, 'C3');
        $c4_values = array_column($matriksKeputusan, 'C4');

        $a0 = [
            'menu_id'   => 'A0',
            'nama_menu' => 'Nilai Optimum (A0)',
            'C1'        => max($c1_values),
            'C2'        => max($c2_values),
            'C3'        => max($c3_values),
            'C4'        => min($c4_values),
        ];

        array_unshift($matriksKeputusan, $a0);
        return $matriksKeputusan;
    }

    private function step3_Normalisasi($matriksDenganA0)
    {
        $matriksNormalisasi = [];

        // Hitung total nilai (penyebut) untuk setiap kriteria dari semua baris (termasuk A0)
        $sumC1 = 0; $sumC2 = 0; $sumC3 = 0; $sumC4_invers = 0;

        foreach ($matriksDenganA0 as $baris) {
            $sumC1 += $baris['C1'];
            $sumC2 += $baris['C2'];
            $sumC3 += $baris['C3'];

            // Rumus Cost: Jumlahkan 1/X
            if ($baris['C4'] > 0) {
                $sumC4_invers += (1 / $baris['C4']);
            }
        }

        // Lakukan pembagian normalisasi
        foreach ($matriksDenganA0 as $baris) {
            $r_C1 = $sumC1 > 0 ? $baris['C1'] / $sumC1 : 0;
            $r_C2 = $sumC2 > 0 ? $baris['C2'] / $sumC2 : 0;
            $r_C3 = $sumC3 > 0 ? $baris['C3'] / $sumC3 : 0;

            // Rumus normalisasi Cost: (1/X) / Sum(1/X)
            $r_C4 = 0;
            if ($baris['C4'] > 0 && $sumC4_invers > 0) {
                $r_C4 = (1 / $baris['C4']) / $sumC4_invers;
            }

            $matriksNormalisasi[] = [
                'menu_id'   => $baris['menu_id'],
                'nama_menu' => $baris['nama_menu'],
                'C1'        => $r_C1,
                'C2'        => $r_C2,
                'C3'        => $r_C3,
                'C4'        => $r_C4,
            ];
        }

        return $matriksNormalisasi;
    }

    private function step4_NormalisasiTerbobot($matriksNormalisasi, $kriteria)
    {
        $matriksTerbobot = [];

        // Ekstrak nilai bobot dari database (C1=0.50, C2=0.30, C3=0.10, C4=0.10)
        $w_C1 = $kriteria->where('kode_kriteria', 'C1')->first()->bobot_kriteria ?? 0;
        $w_C2 = $kriteria->where('kode_kriteria', 'C2')->first()->bobot_kriteria ?? 0;
        $w_C3 = $kriteria->where('kode_kriteria', 'C3')->first()->bobot_kriteria ?? 0;
        $w_C4 = $kriteria->where('kode_kriteria', 'C4')->first()->bobot_kriteria ?? 0;

        foreach ($matriksNormalisasi as $baris) {
            $matriksTerbobot[] = [
                'menu_id'   => $baris['menu_id'],
                'nama_menu' => $baris['nama_menu'],
                'C1'        => $baris['C1'] * $w_C1,
                'C2'        => $baris['C2'] * $w_C2,
                'C3'        => $baris['C3'] * $w_C3,
                'C4'        => $baris['C4'] * $w_C4,
            ];
        }

        return $matriksTerbobot;
    }

    private function step5_Perankingan($matriksTerbobot)
    {
        $hasilAkhir = [];
        $S0 = 0; // Menampung Nilai S dari baris A0

        // 1. Menghitung nilai Fungsi Optimum (Si)
        foreach ($matriksTerbobot as $baris) {
            $Si = $baris['C1'] + $baris['C2'] + $baris['C3'] + $baris['C4'];

            if ($baris['menu_id'] === 'A0') {
                $S0 = $Si;
            }

            $hasilAkhir[] = [
                'menu_id'   => $baris['menu_id'],
                'nama_menu' => $baris['nama_menu'],
                'Si'        => $Si,
                'Ki'        => 0,
            ];
        }

        // 2. Menghitung Derajat Utilitas (Ki) = Si / S0
        foreach ($hasilAkhir as $key => $baris) {
            $hasilAkhir[$key]['Ki'] = $S0 > 0 ? $baris['Si'] / $S0 : 0;
        }

        // 3. Mengurutkan Data (Ranking) berdasarkan nilai Ki terbesar
        // Keluarkan baris A0 terlebih dahulu karena A0 adalah patokan, bukan untuk diranking
        $barisA0 = array_shift($hasilAkhir);

        usort($hasilAkhir, function($a, $b) {
            return $b['Ki'] <=> $a['Ki']; // Urutkan dari terbesar ke terkecil
        });

        // Beri nomor ranking pada hasil yang sudah diurutkan
        foreach ($hasilAkhir as $index => $baris) {
            $hasilAkhir[$index]['rank'] = $index + 1;
        }

        // Masukkan kembali A0 ke paling atas agar bisa ditampilkan dosen di tabel hasil
        $barisA0['rank'] = '-';
        array_unshift($hasilAkhir, $barisA0);

        return $hasilAkhir;
    }
}
