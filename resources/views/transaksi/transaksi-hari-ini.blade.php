<x-template>
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Pesanan Transaksi Hari Ini</h4>
                <a href="{{ route('pos') }}" class="btn btn-primary btn-sm">Kembali ke POS</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tabelData" class="display table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%; text-align: center;">No</th>
                                <th>Waktu</th>
                                <th>Transaksi</th>
                                <th>Kasir</th>
                                <th>Total</th>
                                <th style="width: 15%; text-align: center;">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $item)
                                <tr>
                                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                                    <td>{{ $item->created_at->format('H:i') }} WIB</td>
                                    <td>
                                        <strong>{{ $item->kode_transaksi }}</strong><br>
                                        <small class="text-muted">{{ $item->nama_customer }}
                                            ({{ $item->metodePembayaran->nama_metode ?? '-' }})
                                        </small>
                                    </td>
                                    <td>{{ $item->user->name ?? 'Kasir' }}</td>
                                    <td><strong>Rp {{ number_format($item->bayar, 0, ',', '.') }}</strong></td>
                                    <td style="text-align: center;">
                                        <!-- Tombol pemicu Modal, kita titipkan data JSON di atribut data-detail -->
                                        <button type="button" class="btn btn-info btn-sm text-white"
                                            data-kode="{{ $item->kode_transaksi }}"
                                            data-waktu="{{ $item->created_at->format('d/m/Y H:i') }}"
                                            data-customer="{{ $item->nama_customer }}"
                                            data-metode="{{ $item->metodePembayaran->nama_metode ?? '-' }}"
                                            data-kasir="{{ $item->user->name ?? 'Kasir' }}"
                                            data-total="{{ $item->subtotal }}" data-bayar="{{ $item->bayar }}"
                                            data-kembalian="{{ $item->kembalian }}"
                                            data-detail="{{ $item->detailTransaksi }}" onclick="bukaModalDetail(this)">
                                            Lihat Detail
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Transaksi (Desain Struk) -->
    <div class="modal fade" id="modalDetailTransaksi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm"> <!-- Pakai modal-sm agar ukurannya pas seperti struk -->
            <div class="modal-content">
                <div class="modal-header bg-dark text-white py-2">
                    <h6 class="modal-title text-white mb-0">Detail Struk</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="background-color: #fcfcfc;">
                    <!-- Header Struk -->
                    <div class="text-center mb-3">
                        <h5 class="fw-bold mb-0">WARKOP GARASI</h5>
                        <small class="text-muted" id="modalWaktu"></small><br>
                        <small class="text-muted">No: <span id="modalKodeTrx"></span></small>
                    </div>

                    <hr style="border-top: 2px dashed #ccc;">

                    <!-- Info Customer, Pembayaran, & Kasir -->
                    <div class="d-flex justify-content-between mb-1">
                        <small>Pelanggan:</small>
                        <small class="fw-bold" id="modalCustomer"></small>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <small>Kasir:</small>
                        <small class="fw-bold" id="modalKasir"></small> {{-- <-- TAMBAHKAN INI --}}
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <small>Pembayaran:</small>
                        <small class="fw-bold text-uppercase" id="modalMetode"></small>
                    </div>

                    <hr style="border-top: 2px dashed #ccc;">

                    <!-- Daftar Pesanan -->
                    <ul class="list-unstyled mb-3" id="listIsiPesanan">
                        <!-- JavaScript akan menyuntikkan pesanan di sini -->
                    </ul>

                    <hr style="border-top: 2px dashed #ccc;">

                    <!-- Rincian Biaya -->
                    <div class="d-flex justify-content-between mb-1">
                        <span>Total Harga</span>
                        <span class="fw-bold" id="modalTotal"></span>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span>Bayar</span>
                        <span id="modalBayar"></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Kembalian</span>
                        <span id="modalKembalian"></span>
                    </div>
                </div>
                <div class="modal-footer text-center w-100 d-block py-2 bg-light">
                    <small class="text-muted fst-italic">Terima kasih atas kunjungannya!</small>
                </div>
            </div>
        </div>
    </div>

    <script>
        function bukaModalDetail(button) {
            // 1. Ambil semua atribut data dari tombol
            let kodeTrx = button.getAttribute('data-kode');
            let waktu = button.getAttribute('data-waktu');
            let customer = button.getAttribute('data-customer');
            let kasir = button.getAttribute('data-kasir');
            let metode = button.getAttribute('data-metode');
            let totalTagihan = parseInt(button.getAttribute('data-total'));
            let uangBayar = parseInt(button.getAttribute('data-bayar'));
            let uangKembalian = parseInt(button.getAttribute('data-kembalian'));
            let detailPesanan = JSON.parse(button.getAttribute('data-detail'));

            // Fungsi bantuan untuk memformat Rupiah
            let formatRupiah = (angka) => 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);

            // 2. Tembakkan data ke header & info struk
            document.getElementById('modalKodeTrx').innerText = kodeTrx;
            document.getElementById('modalWaktu').innerText = waktu;
            document.getElementById('modalCustomer').innerText = customer ? customer : 'Umum';
            document.getElementById('modalKasir').innerText = kasir;
            document.getElementById('modalMetode').innerText = metode;

            // 3. Looping data pesanan
            let htmlList = '';
            detailPesanan.forEach(item => {
                let namaMenu = item.menu ? item.menu.nama : 'Menu Telah Dihapus';
                htmlList += `
                <li class="d-flex justify-content-between mb-2">
                    <div style="line-height: 1.2;">
                        <span class="fw-bold d-block" style="font-size: 0.9rem;">${namaMenu}</span>
                        <small class="text-muted">${item.qty} x ${formatRupiah(item.harga_satuan)}</small>
                    </div>
                    <span class="fw-bold" style="font-size: 0.9rem;">${formatRupiah(item.subtotal)}</span>
                </li>
            `;
            });
            document.getElementById('listIsiPesanan').innerHTML = htmlList;

            // 4. Tembakkan data total, bayar, dan kembalian ke footer struk
            document.getElementById('modalTotal').innerText = formatRupiah(totalTagihan);
            document.getElementById('modalBayar').innerText = formatRupiah(uangBayar);
            document.getElementById('modalKembalian').innerText = formatRupiah(uangKembalian);

            // 5. Tampilkan Modal
            let modal = new bootstrap.Modal(document.getElementById('modalDetailTransaksi'));
            modal.show();
        }
    </script>

    @push('script')
        <script>
            $(document).ready(function() {
                $('#tabelData').DataTable();
            });
        </script>
    @endpush
</x-template>
