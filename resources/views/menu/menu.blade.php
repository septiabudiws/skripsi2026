<x-template>
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Daftar Menu</h4>
                <a href="/menu/create" class="btn btn-primary btn-sm">Tambah Menu Baru</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tabelMenu" class="display table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%; text-align: center;">No</th>
                                <th>Nama Menu</th>
                                <th>Harga Jual</th>
                                <th>HPP</th>
                                <th>Margin Profit</th>
                                <th style="width: 20%; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menu as $item)
                                <tr>
                                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>@rupiah($item->harga)</td>
                                    <td>@rupiah($item->hpp)</td>
                                    <td>{{ round($item->margin_profit * 100) }}%</td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('menu.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm me-1">Update</a>
                                        <form action="{{ route('menu.destroy', $item->id) }}" method="POST"
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
                $('#tabelMenu').DataTable();
            });

            function confirmDelete(id) {
                Swal.fire({
                    title: 'Peringatan Hapus Menu!',
                    html: `Menghapus menu ini akan berdampak pada data terkait secara permanen.<br><br>
               <span style="color: red; font-weight: bold;">Dampak Fatal:</span><br>
               Data <b>Riwayat Transaksi</b> yang memuat pesanan menu ini serta <b>Data Perhitungan ARAS</b> (sebagai alternatif) akan ikut terhapus atau mengalami kerusakan!<br><br>
               Apakah Anda benar-benar yakin ingin menghapusnya?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus Menu!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true // Tombol Batal di kanan untuk mencegah human error
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }
        </script>
    @endpush
</x-template>
