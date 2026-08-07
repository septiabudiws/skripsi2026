<x-template title="Perankingan Menu Optimal (Metode ARAS) | Warkop Garasi">
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Perankingan Menu Optimal (Metode ARAS)</h4>
            </div>
            <div class="card-body">

                <!-- BAGIAN FORM FILTER -->
                <form action="{{ url()->current() }}" method="GET" class="mb-4 bg-light p-3 border rounded">
                    <div class="row g-2 align-items-center">
                        <!-- Pilihan Bulan -->
                        <div class="col-auto">
                            <label for="bulan" class="col-form-label fw-bold">Pilih Bulan:</label>
                        </div>
                        <div class="col-auto">
                            <select name="bulan" id="bulan" class="form-select form-select-sm">
                                <option value="">-- Semua Bulan --</option>
                                @foreach ($bulanIndo as $angka => $nama)
                                    <option value="{{ $angka }}"
                                        {{ request('bulan') == $angka ? 'selected' : '' }}>
                                        {{ $nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Pilihan Tahun -->
                        <div class="col-auto ms-md-3">
                            <label for="tahun" class="col-form-label fw-bold">Tahun:</label>
                        </div>
                        <div class="col-auto">
                            <select name="tahun" id="tahun" class="form-select form-select-sm">
                                @for ($i = $tahunSekarang; $i >= $tahunSekarang - 2; $i--)
                                    <option value="{{ $i }}"
                                        {{ request('tahun', $tahunSekarang) == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="col-auto ms-3">
                            <button type="submit" class="btn btn-primary btn-sm px-4">Terapkan</button>
                            <a href="{{ url()->current() }}" class="btn btn-secondary btn-sm">Reset</a>
                        </div>
                    </div>
                </form>
                <!-- AKHIR BAGIAN FORM FILTER -->

                <!-- BAGIAN HASIL PERHITUNGAN ARAS (TABS) -->
                @if(empty($hasilAras['step1']))
                    <div class="alert alert-warning mt-4">
                        Tidak ada data transaksi penjualan pada periode ini. Silakan ubah filter bulan dan tahun.
                    </div>
                @else
                    <!-- NAVIGASI TABS (BOOTSTRAP 5) -->
                    <ul class="nav nav-tabs mt-4" id="arasTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#step1" type="button" role="tab">1. Matriks Awal (X)</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#step2" type="button" role="tab">2. Matriks + A0</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#step3" type="button" role="tab">3. Normalisasi (R)</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#step4" type="button" role="tab">4. Terbobot (V)</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold text-success" data-bs-toggle="tab" data-bs-target="#step5" type="button" role="tab">5. Perankingan Akhir</button>
                        </li>
                    </ul>

                    <!-- KONTEN TABS -->
                    <div class="tab-content mt-3 mb-5" id="arasTabContent">

                        <!-- TAB 1: MATRIKS AWAL -->
                        <div class="tab-pane fade show active" id="step1" role="tabpanel">
                            <div class="table-responsive">
                                <table class="display table table-hover table-bordered table-striped" style="width:100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Menu</th>
                                            <th>C1 (Profit)</th>
                                            <th>C2 (Margin Profit)</th>
                                            <th>C3 (Kuantitas)</th>
                                            <th>C4 (Harga Modal)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($hasilAras['step1'] as $index => $baris)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $baris['nama_menu'] }}</td>
                                            <td>{{ number_format($baris['C1'], 2) }}</td>
                                            <td>{{ number_format($baris['C2'], 4) }}</td>
                                            <td>{{ $baris['C3'] }}</td>
                                            <td>{{ number_format($baris['C4'], 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- TAB 2: MATRIKS DENGAN A0 -->
                        <div class="tab-pane fade" id="step2" role="tabpanel">
                            <div class="table-responsive">
                                <table class="display table table-hover table-bordered" style="width:100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nama Menu</th>
                                            <th>C1 (Max)</th>
                                            <th>C2 (Max)</th>
                                            <th>C3 (Max)</th>
                                            <th>C4 (Min)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($hasilAras['step2'] as $baris)
                                        <tr class="{{ $baris['menu_id'] === 'A0' ? 'table-warning fw-bold' : '' }}">
                                            <td>{{ $baris['nama_menu'] }}</td>
                                            <td>{{ number_format($baris['C1'], 2) }}</td>
                                            <td>{{ number_format($baris['C2'], 4) }}</td>
                                            <td>{{ number_format($baris['C3'], 4) }}</td>
                                            <td>{{ number_format($baris['C4'], 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- TAB 3: NORMALISASI -->
                        <div class="tab-pane fade" id="step3" role="tabpanel">
                            <div class="table-responsive">
                                <table class="display table table-hover table-bordered" style="width:100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nama Menu</th>
                                            <th>C1</th>
                                            <th>C2</th>
                                            <th>C3</th>
                                            <th>C4</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($hasilAras['step3'] as $baris)
                                        <tr class="{{ $baris['menu_id'] === 'A0' ? 'table-warning fw-bold' : '' }}">
                                            <td>{{ $baris['nama_menu'] }}</td>
                                            <td>{{ number_format($baris['C1'], 4) }}</td>
                                            <td>{{ number_format($baris['C2'], 4) }}</td>
                                            <td>{{ number_format($baris['C3'], 4) }}</td>
                                            <td>{{ number_format($baris['C4'], 4) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- TAB 4: TERBOBOT -->
                        <div class="tab-pane fade" id="step4" role="tabpanel">
                            <div class="table-responsive">
                                <table class="display table table-hover table-bordered" style="width:100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nama Menu</th>
                                            <th>C1</th>
                                            <th>C2</th>
                                            <th>C3</th>
                                            <th>C4</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($hasilAras['step4'] as $baris)
                                        <tr class="{{ $baris['menu_id'] === 'A0' ? 'table-warning fw-bold' : '' }}">
                                            <td>{{ $baris['nama_menu'] }}</td>
                                            <td>{{ number_format($baris['C1'], 4) }}</td>
                                            <td>{{ number_format($baris['C2'], 4) }}</td>
                                            <td>{{ number_format($baris['C3'], 4) }}</td>
                                            <td>{{ number_format($baris['C4'], 4) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- TAB 5: PERANKINGAN AKHIR -->
                        <div class="tab-pane fade" id="step5" role="tabpanel">
                            <div class="table-responsive">
                                <table class="display table table-hover table-bordered" style="width:100%">
                                    <thead class="table-primary">
                                        <tr>
                                            <th class="text-center">Rank</th>
                                            <th>Nama Menu</th>
                                            <th>Fungsi Optimum ($S_i$)</th>
                                            <th>Derajat Utilitas ($K_i$)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($hasilAras['step5'] as $baris)
                                        <tr class="{{ $baris['menu_id'] === 'A0' ? 'table-warning fw-bold' : '' }}">
                                            <td class="text-center">{{ $baris['rank'] }}</td>
                                            <td>{{ $baris['nama_menu'] }}</td>
                                            <td>{{ number_format($baris['Si'], 5) }}</td>
                                            <td>{{ number_format($baris['Ki'], 5) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                @endif
                <!-- AKHIR BAGIAN HASIL PERHITUNGAN ARAS -->

            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                // Menerapkan DataTables ke semua tabel yang memiliki class 'display'
                $('.display').DataTable({
                    "pageLength": 10,
                    "ordering": false // Dimatikan agar urutan ranking dan posisi A0 tidak berantakan saat di-klik
                });
            });
        </script>
    @endpush
</x-template>
