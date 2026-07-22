<x-template>
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Update Data Menu</h4>
            </div>
            <div class="card-body">
                <form action="#" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nama Menu</label>
                        <input type="text" class="form-control" name="nama_menu" value="Mie Instan Telur 2 Sawi">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga Jual (Rp)</label>
                        <input type="number" class="form-control" name="harga" value="15000">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">HPP (Rp)</label>
                        <input type="number" class="form-control" name="hpp" value="8000">
                    </div>

                    <button type="submit" class="btn btn-warning">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-template>
