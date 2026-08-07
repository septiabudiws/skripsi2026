<x-template title="Manajemen Karyawan | Warkop Garasi">
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Manajemen Karyawan</h4>
                {{-- <a href="#" class="btn btn-primary btn-sm">Tambah Karyawan</a> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tabelData" class="display table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%; text-align: center;">No</th>
                                <th>Nama Karyawan</th>
                                <th>Email Karyawan</th>
                                <th>Status</th>
                                <th style="width: 20%; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($karyawan as $item)
                                <tr>
                                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td style="text-align: center;">
                                        <form action="{{ route('karyawan.update-status', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-check form-switch d-inline-block">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    name="status" value="aktif" onchange="this.form.submit()"
                                                    {{ $item->status == 'aktif' ? 'checked' : '' }}
                                                    style="cursor: pointer;">
                                            </div>
                                        </form>
                                    </td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-info btn-sm text-white"
                                            data-bs-toggle="modal" data-bs-target="#modalAkses-{{ $item->id }}">
                                            Akses
                                        </button>
                                        {{-- <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="#" method="POST" class="d-inline"
                                            id="delete-form-{{ $item->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $item->id }})">Delete</button>
                                        </form> --}}
                                    </td>
                                </tr>
                                <div class="modal fade" id="modalAkses-{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="modalAksesLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content text-start">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalAksesLabel">Atur Akses:
                                                    {{ $item->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('karyawan.update-permissions', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-check form-switch mb-3">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            name="permissions[]" value="akses_kategori"
                                                            {{ $item->hasPermissionTo('akses_kategori') ? 'checked' : '' }}>
                                                        <label class="form-check-label">Akses Kategori</label>
                                                    </div>
                                                    <div class="form-check form-switch mb-3">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            name="permissions[]" value="akses_menu"
                                                            {{ $item->hasPermissionTo('akses_menu') ? 'checked' : '' }}>
                                                        <label class="form-check-label">Akses Menu</label>
                                                    </div>
                                                    <div class="form-check form-switch mb-3">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            name="permissions[]" value="akses_kriteria"
                                                            {{ $item->hasPermissionTo('akses_kriteria') ? 'checked' : '' }}>
                                                        <label class="form-check-label">Akses Kriteria</label>
                                                    </div>
                                                    <div class="form-check form-switch mb-3">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            name="permissions[]" value="akses_metode_pembayaran"
                                                            {{ $item->hasPermissionTo('akses_metode_pembayaran') ? 'checked' : '' }}>
                                                        <label class="form-check-label">Akses Metode Pembayaran</label>
                                                    </div>
                                                    <div class="form-check form-switch mb-3">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            name="permissions[]" value="akses_pos"
                                                            {{ $item->hasPermissionTo('akses_pos') ? 'checked' : '' }}>
                                                        <label class="form-check-label">Akses POS</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Akses</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
        </script>
    @endpush
</x-template>
