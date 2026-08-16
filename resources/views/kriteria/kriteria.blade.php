<x-template title="Manajemen Kriteria | Warkop Garasi">
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Manajemen Kriteria</h4>

                <!-- Pembungkus Info Bobot dan Tombol Tambah -->
                <div class="d-flex align-items-center">

                    <!-- Informasi Total Bobot -->
                    <div class="me-3 text-end">
                        <strong>Total Bobot: </strong>
                        <span class="badge {{ $totalBobot == 1 ? 'bg-success' : ($totalBobot > 1 ? 'bg-danger' : 'bg-warning text-dark') }}" style="font-size: 14px;">
                            {{ number_format($totalBobot, 4) }}
                        </span>
                        @if($totalBobot < 1)
                            <small class="text-muted d-block" style="font-size: 11px;">(Kurang {{ number_format(1 - $totalBobot, 4) }} lagi)</small>
                        @endif
                    </div>

                    <!-- Logika Tombol Tambah Kriteria -->
                    @if($totalBobot >= 1)
                        <button type="button" class="btn btn-primary btn-sm" onclick="alertBobotPenuh()">Tambah Kriteria</button>
                    @else
                        <a href="{{ route('kriteria.create') }}" class="btn btn-primary btn-sm">Tambah Kriteria</a>
                    @endif

                </div>
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
                            @foreach ($kriteria as $item)
                                <tr>
                                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode_kriteria }}</td>
                                    <td>{{ $item->nama_kriteria }}</td>
                                    <td>{{ number_format($item->bobot_kriteria, 4) }}</td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('kriteria.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('kriteria.destroy', $item->id) }}" method="POST"
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

            // SweetAlert untuk Konfirmasi Hapus Data
            function confirmDelete(id) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data kriteria ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }

            // SweetAlert Peringatan Batas Maksimal Bobot Kriteria
            function alertBobotPenuh() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Batas Bobot Tercapai!',
                    text: 'Total bobot kriteria saat ini sudah mencapai 1.0000 (100%). Anda tidak bisa menambahkan kriteria baru. Silakan edit atau kurangi bobot kriteria yang ada terlebih dahulu.',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Mengerti'
                });
            }
        </script>
    @endpush
</x-template>
