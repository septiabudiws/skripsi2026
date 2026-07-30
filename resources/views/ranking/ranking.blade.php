<x-template>
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Perakingan Menu Optimal</h4>
                <a href="#" class="btn btn-primary btn-sm">Tambah Kategori</a>
            </div>
            <div class="card-body">
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
                <div class="table-responsive">
                    <table id="tabelData" class="display table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%; text-align: center;">No</th>
                                <th>Nama Menu</th>
                                <th>HPP</th>
                                <th>Harga</th>
                                <th>Nilai</th>
                                <th style="width: 20%; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $('#tabelData').DataTable();
            });

            function confirmDelete(id) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data kategori ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    // Jika user mengklik "Ya, hapus!"
                    if (result.isConfirmed) {
                        // Jalankan proses submit pada form yang sesuai dengan ID
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }
        </script>
    @endpush
</x-template>
