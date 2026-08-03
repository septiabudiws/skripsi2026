<x-template>
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Manajemen Kategori</h4>
                <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm">Tambah Kategori</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tabelData" class="display table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%; text-align: center;">No</th>
                                <th>Nama Kategori</th>
                                <th>Qty</th>
                                <th style="width: 20%; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $item)
                                <tr>
                                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_kategori }}</td>
                                    <td>{{ $item->menu_count }}</td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('kategori.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm me-1">Update</a>
                                        <form action="{{ route('kategori.destroy', $item->id) }}" method="POST"
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
                    title: 'Peringatan Keras!',
                    html: `Menghapus kategori ini akan <b>menghapus seluruh Menu</b> yang ada di dalamnya.<br><br>
               <span style="color: red; font-weight: bold;">Dampak Fatal:</span><br>
               Seluruh riwayat <b>Transaksi Penjualan</b> yang terkait dengan menu tersebut dan <b>Data Perhitungan ARAS</b> juga bisa ikut terhapus atau mengalami kerusakan!<br><br>
               Apakah Anda benar-benar yakin?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus Permanen!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true // Membalik posisi tombol agar 'Batal' di kanan (mencegah salah klik)
                }).then((result) => {
                    // Jika user mengklik "Ya, Hapus Permanen!"
                    if (result.isConfirmed) {
                        // Jalankan proses submit pada form yang sesuai dengan ID
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }
        </script>
    @endpush
</x-template>
