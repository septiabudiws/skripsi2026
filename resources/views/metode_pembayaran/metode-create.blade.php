<x-template title="Tambah Metode Pembayaran | Warkop Garasi">
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Tambah Metode Pembayaran</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('metode.store') }}" method="POST">
                    @csrf
                    <div class="mb-3"><label class="form-label">Metode Pembayaran</label><input type="text"
                            class="form-control @error('metode') is-invalid @enderror" name="metode"
                            placeholder="contoh: Cash, Transfer" value="{{ old('metode') }}">
                        @error('metode')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-template>
