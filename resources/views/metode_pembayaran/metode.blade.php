<x-template title="Manajemen Metode Pembayaran | Warkop Garasi">
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Manajemen Metode Pembayaran</h4>
                <a href="{{ route('metode.create') }}" class="btn btn-primary btn-sm">Tambah Metode</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tabelData" class="display table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%; text-align: center;">No</th>
                                <th>Metode Pembayaran</th>
                                <th>Status</th>
                                <th style="width: 20%; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($metode as $item)
                                <tr>
                                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_metode }}</td>
                                    <td style="text-align: center;">
                                        <!-- Form kecil untuk update status aktif/nonaktif -->
                                        <form action="{{ route('metode.toggle-status', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-check form-switch d-inline-block">
                                                <!-- this.form.submit() akan otomatis nge-save saat diklik -->
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    onchange="this.form.submit()"
                                                    {{ $item->is_active ? 'checked' : '' }} style="cursor: pointer;">
                                            </div>
                                        </form>
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('metode.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('metode.destroy', $item->id) }}" method="POST"
                                            class="d-inline" id="delete-form-{{ $item->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $item->id }})">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
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
                    title: 'Peringatan Hapus Metode Pembayaran!',
                    html: `Menghapus metode pembayaran ini akan berdampak pada riwayat kasir.<br><br>
               <span style="color: red; font-weight: bold;">Dampak Fatal:</span><br>
               Seluruh <b>Riwayat Transaksi</b> dan <b>Laporan Rekapitulasi</b> yang menggunakan metode pembayaran ini akan kehilangan referensi datanya dan berisiko mengalami error!<br><br>
               Apakah Anda benar-benar yakin ingin menghapusnya?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true // Membalik posisi tombol agar 'Batal' di kanan (mencegah salah klik)
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }
        </script>
    @endpush
</x-template>
