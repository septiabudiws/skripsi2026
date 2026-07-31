<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan Warkop Garasi</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 10pt; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h2 { margin: 0; padding: 0; font-size: 16pt; font-weight: bold; }
        .header p { margin: 5px 0 0 0; font-size: 10pt; }

        .summary-box { width: 100%; margin-bottom: 20px; border-collapse: collapse; }
        .summary-box td { padding: 5px; }
        .summary-label { font-weight: bold; width: 150px; }

        .table-data { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .table-data th, .table-data td { border: 1px solid #999; padding: 8px; text-align: left; }
        .table-data th { background-color: #f0f0f0; font-weight: bold; text-align: center; }

        .text-center { text-align: center !important; }
        .text-right { text-align: right !important; }
        .fw-bold { font-weight: bold; }

        .footer-signature { width: 100%; margin-top: 50px; }
        .footer-signature td { width: 50%; text-align: center; }
        .ttd-area { height: 80px; }
    </style>
</head>
<body>

    <!-- KOP Laporan / Header -->
    <div class="header">
        <h2>WARKOP GARASI</h2>
        <p>Laporan Rekapitulasi Penjualan</p>
    </div>

    <!-- Ringkasan Filter & Keuangan -->
    <table class="summary-box">
        <tr>
            <td class="summary-label">Periode</td>
            <td>: {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}</td>
            <td class="summary-label">Total Omzet</td>
            <td class="fw-bold">: @rupiah($totalOmzet)</td>
        </tr>
        <tr>
            <td class="summary-label">Kasir / Karyawan</td>
            <td>: {{ $namaKasir }}</td>
            <td class="summary-label">Pembayaran Tunai</td>
            <td>: @rupiah($totalTunai)</td>
        </tr>
        <tr>
            <td class="summary-label">Waktu Cetak</td>
            <td>: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</td>
            <td class="summary-label">Pembayaran Non-Tunai</td>
            <td>: @rupiah($totalTransfer + $totalQris)</td>
        </tr>
    </table>

    <!-- Tabel Data Transaksi -->
    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">No. Struk</th>
                <th style="width: 20%;">Waktu Transaksi</th>
                <th style="width: 25%;">Nama Kasir</th>
                <th style="width: 15%;">Metode</th>
                <th style="width: 20%;">Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $index => $trx)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">#TRX-{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($trx->created_at)->format('d/m/Y H:i') }}</td>
                    <td>{{ $trx->user->nama ?? $trx->user->name ?? '-' }}</td>
                    <td class="text-center">{{ $trx->metodePembayaran->nama ?? $trx->metodePembayaran->nama_metode ?? '-' }}</td>
                    <td class="text-right">@rupiah($trx->subtotal)</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data transaksi pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
        <!-- Baris Grand Total di bagian bawah tabel -->
        <tfoot>
            <tr>
                <th colspan="5" class="text-right">GRAND TOTAL PENDAPATAN</th>
                <th class="text-right">@rupiah($totalOmzet)</th>
            </tr>
        </tfoot>
    </table>

    <!-- Kolom Tanda Tangan (Footer Formal) -->
    <table class="footer-signature">
        <tr>
            <td>
                Mengetahui,<br>
                <strong>Supervisor / Pemilik</strong>
                <div class="ttd-area"></div>
                ( ...................................... )
            </td>
            <td>
                Sumenep, {{ \Carbon\Carbon::now()->format('d F Y') }}<br>
                <strong>Admin / Kasir Bertugas</strong>
                <div class="ttd-area"></div>
                ( ...................................... )
            </td>
        </tr>
    </table>

</body>
</html>
