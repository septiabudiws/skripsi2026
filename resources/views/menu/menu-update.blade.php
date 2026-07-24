<x-template>
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Update Data Menu</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('menu.update', $menu->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nama Menu</label>
                        <input type="text" class="form-control @error('nama_menu') is-invalid @enderror"
                            name="nama_menu" value="{{ $menu->nama }}">
                        @error('nama_menu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select class="form-control @error('kategori_id') is-invalid @enderror" name="kategori_id">
                            <option value="">-- Pilih Kategori --</option>

                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}"
                                    {{ $menu->kategori_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_kategori }}
                                </option>
                            @endforeach
                        </select>

                        @error('kategori_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="mb-3">
                            <label class="form-label">Harga Jual (Rp)</label>
                            <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                name="harga" value="{{ $menu->harga }}">
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">HPP (Rp)</label>
                            <input type="number" class="form-control @error('hpp') is-invalid @enderror" name="hpp"
                                value="{{ $menu->hpp }}">
                            @error('hpp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-warning">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-template>
