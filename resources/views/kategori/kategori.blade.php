<x-template>
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Manajemen Kategori</h4>
                <a href="/kategori/create" class="btn btn-primary btn-sm">Tambah Kategori</a>
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
                            <!-- Contoh Data 1 -->
                            <tr>
                                <td style="text-align: center;">1</td>
                                <td>Makanan Utama</td>
                                <td>45</td>
                                <td style="text-align: center;">
                                    <!-- Tombol Update (Kuning) -->
                                    <a href="/kategori/edit" class="btn btn-warning btn-sm me-1">Update</a>
                                    <!-- Tombol Delete (Merah) -->
                                    <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>

                            <!-- Contoh Data 2 -->
                            <tr>
                                <td style="text-align: center;">2</td>
                                <td>Minuman Dingin</td>
                                <td>120</td>
                                <td style="text-align: center;">
                                    <a href="/kategori/edit" class="btn btn-warning btn-sm me-1">Update</a>
                                    <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                </td>
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
        </script>
    @endpush
</x-template>
