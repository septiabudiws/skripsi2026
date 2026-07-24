<x-template>
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Edit Kategori</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3"><label class="form-label">Nama Kategori</label><input type="text"
                            class="form-control @error('nama_kategori') is-invalid @enderror"
                            placeholder="Nama Kategori" value="{{ $kategori->nama_kategori }}" name="nama_kategori">
                        @error('nama_kategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-warning">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-template>
