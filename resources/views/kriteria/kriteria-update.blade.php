<x-template title="Edit Kriteria | Warkop Garasi">
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Edit Kriteria</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3"><label class="form-label">Kode Kriteria</label><input type="text"
                            class="form-control @error('kode') is-invalid @enderror" name="kode"
                            placeholder="Kode Kriteria contoh C1" value="{{ old('kode', $kriteria->kode_kriteria) }}">
                        @error('kode')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3"><label class="form-label">Nama Kriteria</label><input type="text"
                            class="form-control @error('kriteria') is-invalid @enderror" name="kriteria"
                            placeholder="Nama Kriteria" value="{{ old('kriteria', $kriteria->nama_kriteria) }}">
                        @error('kriteria')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3"><label class="form-label">Bobot</label><input type="number"
                            class="form-control @error('bobot') is-invalid @enderror" placeholder="Bobot" step="0.01"
                            value="{{ old('bobot', $kriteria->bobot_kriteria) }}" name="bobot">
                        @error('bobot')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label d-block">Tipe Kriteria</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('tipe') is-invalid @enderror" type="radio"
                                name="tipe" id="tipeBenefit" value="benefit"
                                {{ old('tipe', $kriteria->tipe_kriteria) == 'benefit' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="tipeBenefit">Benefit</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('tipe') is-invalid @enderror" type="radio"
                                name="tipe" id="tipeCost" value="cost"
                                {{ old('tipe', $kriteria->tipe_kriteria) == 'cost' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="tipeCost">Cost</label>
                        </div>
                        @error('tipe')
                            <div class="invalid-feedback d-block">
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
