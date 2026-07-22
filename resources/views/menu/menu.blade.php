<x-template>
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Daftar Menu</h4>
                <!-- Tombol ini nanti href-nya diarahkan ke route form create -->
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
                                <th style="width: 20%; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center;">1</td>
                                <td>Mie Instan Telur 2 Sawi</td>
                                <td>Rp 15.000</td>
                                <td>Rp 8.000</td>
                                <td style="text-align: center;">
                                    <!-- Ubah button jadi tag <a> agar bisa diarahkan ke halaman route update -->
                                    <a href="/menu/edit" class="btn btn-warning btn-sm me-1">Update</a>
                                    <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">2</td>
                                <td>Kopi Hitam</td>
                                <td>Rp 5.000</td>
                                <td>Rp 2.500</td>
                                <td style="text-align: center;">
                                    <a href="/menu/edit" class="btn btn-warning btn-sm me-1">Update</a>
                                    <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT INISIALISASI DATATABLES -->
    @push('script')
    <script>
        $(document).ready(function() {
            $('#tabelMenu').DataTable();
        });
    </script>
    @endpush
</x-template>
