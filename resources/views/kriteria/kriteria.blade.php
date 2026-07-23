<x-template>
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Manajemen Kriteria</h4>
                <a href="/kriteria/create" class="btn btn-primary btn-sm">Tambah Kriteria</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tabelData" class="display table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%; text-align: center;">No</th>
                                <th>Kode Kriteria</th>
                                <th>Nama Kriteria</th>
                                <th>Bobot</th>
                                <th style="width: 20%; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center;">1</td>
                                <td>C1</td>
                                <td>Makanan Utama</td>
                                <td>45</td>
                                <td style="text-align: center;">
                                    <a href="/kriteria/edit" class="btn btn-warning btn-sm me-1">Update</a>
                                    <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">2</td>
                                <td>C2</td>
                                <td>Minuman Dingin</td>
                                <td>120</td>
                                <td style="text-align: center;">
                                    <a href="/kriteria/edit" class="btn btn-warning btn-sm me-1">Update</a>
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
