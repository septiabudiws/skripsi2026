<x-template>
    <!-- BARIS RINGKASAN KEUANGAN -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white shadow-sm">
                <div class="card-body">
                    <h6 class="text-white mb-2">Total Omzet</h6>
                    <h3 class="text-white mb-0">@rupiah($totalOmzet ?? 0)</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white shadow-sm">
                <div class="card-body">
                    <h6 class="text-white mb-2">Tunai (Cash)</h6>
                    <h3 class="text-white mb-0">@rupiah($totalTunai ?? 0)</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white shadow-sm">
                <div class="card-body">
                    <h6 class="text-white mb-2">Transfer Bank</h6>
                    <h3 class="text-white mb-0">@rupiah($totalTransfer ?? 0)</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white shadow-sm">
                <div class="card-body">
                    <h6 class="text-white mb-2">QRIS</h6>
                    <h3 class="text-white mb-0">@rupiah($totalQris ?? 0)</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- AREA FILTER & TABEL -->
    <div class="col-md-12 col-xl-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <h4 class="mb-0">Rekapitulasi Penjualan</h4>
                <a href="{{ route('rekapitulasi.pdf', request()->all()) }}" target="_blank"
                    class="btn btn-danger btn-sm">
                    <i class="feather icon-file-text me-1"></i> Export PDF
                </a>
            </div>

            <div class="card-body">
                <!-- FORM FILTER PENCARIAN -->
                <form method="GET" action="" class="row mb-4 align-items-end bg-light p-3 rounded">
                    <div class="col-md-3 mb-2 mb-md-0">
                        <label class="form-label fw-bold">Tanggal Awal</label>
                        <input type="date" name="start_date" class="form-control"
                            value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-3 mb-2 mb-md-0">
                        <label class="form-label fw-bold">Tanggal Akhir</label>
                        <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-4 mb-2 mb-md-0">
                        <label class="form-label fw-bold">Kasir / Karyawan</label>
                        <select name="user_id" class="form-control">
                            <option value="">-- Semua Karyawan --</option>
                            @foreach ($karyawans ?? [] as $karyawan)
                                <option value="{{ $karyawan->id }}"
                                    {{ request('user_id') == $karyawan->id ? 'selected' : '' }}>
                                    {{ $karyawan->nama ?? $karyawan->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="feather icon-filter"></i> Filter
                        </button>
                    </div>
                </form>

                <hr class="mb-4">

                <!-- TABEL DATATABLES -->
                <div class="table-responsive">
                    <table id="tabelData" class="display table table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%; text-align: center;">No</th>
                                <th>No. Struk</th>
                                <th>Tanggal & Jam</th>
                                <th>Kasir</th>
                                <th>Metode</th>
                                <th>Total Bayar</th>
                                <th style="text-align: center;">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksi ?? [] as $index => $trx)
                                <tr>
                                    <td style="text-align: center;">{{ $index + 1 }}</td>
                                    <td>#TRX-{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($trx->created_at)->format('d/m/Y - H:i') }}</td>
                                    <td>{{ $trx->user->nama ?? ($trx->user->name ?? 'Tidak Diketahui') }}</td>
                                    <td>
                                        @php
                                            $namaMetode = strtolower(
                                                $trx->metodePembayaran->nama ??
                                                    ($trx->metodePembayaran->nama_metode ?? ''),
                                            );
                                        @endphp
                                        @if (str_contains($namaMetode, 'tunai') || str_contains($namaMetode, 'cash'))
                                            <span class="badge bg-success">Tunai</span>
                                        @elseif(str_contains($namaMetode, 'qris'))
                                            <span class="badge bg-warning">QRIS</span>
                                        @elseif(str_contains($namaMetode, 'transfer'))
                                            <span class="badge bg-info">Transfer</span>
                                        @else
                                            <span
                                                class="badge bg-secondary">{{ $trx->metodePembayaran->nama ?? ($trx->metodePembayaran->nama_metode ?? 'Lainnya') }}</span>
                                        @endif
                                    </td>
                                    <td class="fw-bold">@rupiah($trx->subtotal)</td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-sm btn-info text-white"
                                            data-bs-toggle="modal" data-bs-target="#modalDetail{{ $trx->id }}">
                                            Lihat Detail
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">Belum ada data transaksi pada
                                        periode ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- KUMPULAN MODAL DETAIL TRANSAKSI -->
    @foreach ($transaksi ?? [] as $trx)
        <div class="modal fade" id="modalDetail{{ $trx->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-dark border-0 pb-0">
                        <h5 class="modal-title fw-bold text-white">Detail Struk</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 pt-2">
                        <!-- Header Struk -->
                        <div class="text-center mb-4">
                            <h5 class="fw-bold mb-0">WARKOP GARASI</h5>
                            <small
                                class="text-muted">{{ \Carbon\Carbon::parse($trx->created_at)->format('d/m/Y H:i') }}</small><br>
                            <small class="text-muted">No: TRX-{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}</small>
                        </div>

                        <!-- Info Transaksi -->
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted" style="font-size: 0.85rem;">Pelanggan:</span>
                            <span class="fw-bold"
                                style="font-size: 0.85rem;">{{ $trx->nama_pelanggan ?? 'Umum' }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted" style="font-size: 0.85rem;">Kasir:</span>
                            <span class="fw-bold"
                                style="font-size: 0.85rem;">{{ $trx->user->nama ?? ($trx->user->name ?? '-') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted" style="font-size: 0.85rem;">Pembayaran:</span>
                            <span class="fw-bold"
                                style="font-size: 0.85rem;">{{ $trx->metodePembayaran->nama ?? ($trx->metodePembayaran->nama_metode ?? '-') }}</span>
                        </div>

                        <hr style="border-top: 1px dashed #ccc;">

                        <!-- Daftar Item Menu -->
                        @forelse($trx->detailTransaksi as $detail)
                            <div class="d-flex justify-content-between mb-2">
                                <div>
                                    <h6 class="mb-0" style="font-size: 0.9rem;">
                                        {{ $detail->menu->nama ?? 'Item Terhapus' }}</h6>
                                    <small class="text-muted">{{ $detail->qty }} x @rupiah($detail->harga_satuan ?? 0)</small>
                                </div>
                                <span class="fw-bold" style="font-size: 0.9rem;">@rupiah($detail->qty * $detail->harga_satuan ?? 0)</span>
                            </div>
                        @empty
                            <div class="text-center"><small class="text-muted">Detail pesanan tidak ditemukan.</small>
                            </div>
                        @endforelse

                        <hr style="border-top: 1px dashed #ccc;">

                        <!-- Ringkasan Pembayaran -->
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted" style="font-size: 0.9rem;">Total Harga</span>
                            <span class="fw-bold" style="font-size: 0.9rem;">@rupiah($trx->subtotal)</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted" style="font-size: 0.9rem;">Bayar</span>
                            <span class="fw-bold" style="font-size: 0.9rem;">@rupiah($trx->bayar)</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted" style="font-size: 0.9rem;">Kembalian</span>
                            <span class="fw-bold" style="font-size: 0.9rem;">@rupiah($trx->kembalian ?? 0)</span>
                        </div>

                        <div class="text-center mt-4">
                            <small class="text-muted fst-italic">Terima kasih atas kunjungannya!</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @push('script')
        <script>
            $(document).ready(function() {
                $('#tabelData').DataTable({
                    "language": {
                        "search": "Cari Struk:",
                        "lengthMenu": "Tampilkan _MENU_ data",
                        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ transaksi",
                        "paginate": {
                            "first": "Awal",
                            "last": "Akhir",
                            "next": "Lanjut",
                            "previous": "Mundur"
                        }
                    }
                });
            });
        </script>
    @endpush
</x-template>
