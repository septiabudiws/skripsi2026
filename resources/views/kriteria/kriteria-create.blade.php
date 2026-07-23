<x-template>
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Tambah Kriteria</h4>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3"><label class="form-label">Nama Kriteria</label><input type="text"
                            class="form-control" placeholder="Nama Kriteria"></div>
                    <div class="mb-3"><label class="form-label">Bobot</label><input type="number"
                            class="form-control" placeholder="Bobot" step="0.01"></div>
                    <div class="mb-3">
                        <label class="form-label d-block">Tipe Kriteria</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipe" id="tipeBenefit"
                                value="benefit" required>
                            <label class="form-check-label" for="tipeBenefit">Benefit</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipe" id="tipeCost" value="cost"
                                required>
                            <label class="form-check-label" for="tipeCost">Cost</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-template>
