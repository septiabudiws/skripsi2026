<x-template title="Dashboard | Warkop Garasi">
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="card statistics-card-1 overflow-hidden">
                        <div class="card-body"><img
                                src="https://html.phoenixcoded.net/light-able/bootstrap/default/assets/images/widget/img-status-4.svg"
                                alt="img" class="img-fluid img-bg">
                            <h5 class="mb-4">Menu Optimal Bulan Ini</h5>
                            <div class="d-flex align-items-center mt-3">
                                <h3 class="f-w-300 d-flex align-items-center m-b-0">{{ $namaMenuOptimal }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card statistics-card-1 overflow-hidden">
                        <div class="card-body"><img
                                src="https://html.phoenixcoded.net/light-able/bootstrap/default/assets/images/widget/img-status-4.svg"
                                alt="img" class="img-fluid img-bg">
                            <h5 class="mb-4">Total Menu</h5>
                            <div class="d-flex align-items-center mt-3">
                                <h3 class="f-w-300 d-flex align-items-center m-b-0">{{ $totalMenu }} Item</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card statistics-card-1 overflow-hidden">
                        <div class="card-body"><img
                                src="https://html.phoenixcoded.net/light-able/bootstrap/default/assets/images/widget/img-status-5.svg"
                                alt="img" class="img-fluid img-bg">
                            <h5 class="mb-4">Transaksi Hari Ini</h5>
                            <div class="d-flex align-items-center mt-3">
                                <h3 class="f-w-300 d-flex align-items-center m-b-0">{{ $transaksiHariIni }} Struk</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card statistics-card-1 overflow-hidden">
                        <div class="card-body"><img
                                src="https://html.phoenixcoded.net/light-able/bootstrap/default/assets/images/widget/img-status-5.svg"
                                alt="img" class="img-fluid img-bg">
                            <h5 class="mb-4">Total Kategori</h5>
                            <div class="d-flex align-items-center mt-3">
                                <h3 class="f-w-300 d-flex align-items-center m-b-0">{{ $totalKategori }} Kategori</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card statistics-card-1 overflow-hidden bg-brand-color-3">
                        <div class="card-body"><img
                                src="https://html.phoenixcoded.net/light-able/bootstrap/default/assets/images/widget/img-status-6.svg"
                                alt="img" class="img-fluid img-bg">
                            <h5 class="mb-4 text-white">Pendapatan Hari Ini</h5>
                            <div class="d-flex align-items-center mt-3">
                                <h3 class="text-white f-w-300 d-flex align-items-center m-b-0">@rupiah($pendapatanHariIni)</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <!-- Kolom Kanan: Proporsi Kategori (Lebar 4) -->
            <div class="card shadow-sm h-100">
                <div class="card-header border-0">
                    <h6 class="mb-0 fw-bold">Penjualan per Kategori</h6>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <!-- Wadah untuk Donut Chart -->
                    <div id="chart-kategori" style="min-height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
    @can('lihat_chart')
        <div class="row mt-4">
            <div class="col-xl-12 col-lg-12 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header border-0">
                        <h6 class="mb-0 fw-bold">Tren Pendapatan Harian</h6>
                    </div>
                    <div class="card-body">
                        <!-- Wadah untuk Area Chart -->
                        <div id="chart-pendapatan" style="min-height: 300px;"></div>
                    </div>
                    </div>
            </div>
        </div>
    @endcan
    <div class="col-md-12 col-xl-12 mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Transaksi Terbaru</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>No. Struk</th>
                                <th>Jam Transaksi</th>
                                <th>Total Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Melakukan perulangan untuk 3 data transaksi terbaru -->
                            @forelse ($transaksiTerbaru as $trx)
                                <tr>
                                    <!-- Menampilkan ID/No Struk dengan tambahan nol di depan agar rapi -->
                                    <td>#TRX-{{ str_pad($trx->kode_transaksi, 5, '0', STR_PAD_LEFT) }}</td>

                                    <!-- Hanya menampilkan Jam dan Menit -->
                                    <td>{{ $trx->created_at->format('H:i') }} WIB</td>

                                    <!-- Menampilkan nominal dalam Rupiah -->
                                    <td class="fw-bold text-success">
                                        @rupiah($trx->subtotal)
                                    </td>
                                </tr>
                            @empty
                                <!-- Jika belum ada transaksi sama sekali hari ini -->
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">
                                        Belum ada transaksi hari ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                // ==========================================
                // 1. KONFIGURASI AREA CHART (PENDAPATAN)
                // ==========================================
                var optionsPendapatan = {
                    series: [{
                        name: 'Pendapatan (Rp)',
                        // Mengambil variabel PHP dan mengubahnya jadi JSON (Javascript Array)
                        data: @json($dataPendapatan)
                    }],
                    chart: {
                        height: 320,
                        type: 'area',
                        toolbar: {
                            show: false
                        }, // Sembunyikan menu burger di pojok grafik
                        fontFamily: 'inherit'
                    },
                    colors: ['#0d6efd'], // Warna garis utama (Biru Bootstrap)
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.4,
                            opacityTo: 0.05,
                            stops: [0, 90, 100]
                        }
                    },
                    dataLabels: {
                        enabled: false
                    }, // Sembunyikan angka di dalam grafik agar rapi
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    }, // Buat garis melengkung elegan
                    xaxis: {
                        categories: @json($labelPendapatan),
                    },
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return "Rp " + value.toLocaleString('id-ID');
                            }
                        }
                    }
                };

                // Gambar grafik Pendapatan
                var chartPendapatan = new ApexCharts(document.querySelector("#chart-pendapatan"), optionsPendapatan);
                chartPendapatan.render();


                // ==========================================
                // 2. KONFIGURASI DONUT CHART (KATEGORI)
                // ==========================================
                var optionsKategori = {
                    series: @json($dataKategori),
                    labels: @json($labelKategori),
                    chart: {
                        type: 'donut',
                        height: 320,
                        fontFamily: 'inherit'
                    },
                    colors: ['#0d6efd', '#198754', '#ffc107', '#dc3545'], // Warna tiap potongan
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%' // Mengatur ketebalan donat
                            }
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        position: 'bottom' // Pindahkan legenda ke bawah
                    }
                };

                // Gambar grafik Kategori
                var chartKategori = new ApexCharts(document.querySelector("#chart-kategori"), optionsKategori);
                chartKategori.render();

            });
        </script>
    @endpush
</x-template>
