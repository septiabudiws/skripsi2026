<x-template>
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Tambah Menu Baru</h4>
            </div>
            <div class="card-body">
                <form action="#" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Menu</label>
                        <input type="text" class="form-control" name="nama_menu" placeholder="Nama Menu">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga Jual (Rp)</label>
                        <input type="number" class="form-control" name="harga" placeholder="Harga Jual">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">HPP (Rp)</label>
                        <input type="number" class="form-control" name="hpp" placeholder="HPP">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-template>
