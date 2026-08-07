<x-template title="Point of Sale | Warkop Garasi">
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Point of Sale</h4>
                <a href="{{ route('transaksi.hari-ini') }}" class="btn btn-primary btn-sm">Pesanan</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 border-end pb-3">
                        <div class="d-flex gap-2 mb-4 overflow-auto pb-2">
                            <button class="btn btn-primary btn-sm text-nowrap"
                                onclick="filterKategori('semua')">Semua</button>
                            @foreach ($kategori as $item)
                                <button class="btn btn-outline-primary btn-sm text-nowrap"
                                    onclick="filterKategori({{ $item->id }})">
                                    {{ $item->nama_kategori }}
                                </button>
                            @endforeach
                        </div>
                        <div class="row g-3" id="daftarMenu">
                            @foreach ($menu as $item)
                                <div class="col-md-4 col-sm-6 menu-item" data-kategori="{{ $item->kategori_id }}">
                                    <div class="card h-100 border shadow-sm pos-card" style="cursor: pointer;"
                                        onclick="tambahKeKeranjang({{ $item->id }}, '{{ $item->nama }}', {{ $item->harga }})">

                                        <div class="card-body p-3 d-flex flex-column">
                                            <div class="mb-2">
                                                <span class="badge bg-light text-secondary border">
                                                    {{ $item->kategori->nama_kategori ?? 'Umum' }}
                                                </span>
                                            </div>
                                            <h6 class="mb-1 text-dark lh-base">{{ $item->nama }}</h6>
                                            <div class="mt-auto pt-3">
                                                <h5 class="mb-0 text-primary fw-bold">Rp
                                                    {{ number_format($item->harga, 0, ',', '.') }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="bg-primary text-white p-2 mb-3 text-center">
                            <h6 class="mb-0 fw-bold text-light">PESANAN</h6>
                        </div>
                        <div class="mb-3">
                            <input type="text" id="inputNamaCustomer" class="form-control form-control-sm mb-2"
                                placeholder="Nama Customer (Opsional)">
                            <select id="inputMetodeBayar" class="form-select form-select-sm">
                                @foreach ($metodePembayaran as $metode)
                                    <option value="{{ $metode->id }}"
                                        data-nama="{{ strtolower($metode->nama_metode) }}">
                                        {{ $metode->nama_metode }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 pe-2" id="daftarPesanan" style="max-height: 350px; overflow-y: auto;">
                            <!-- Daftar Pesanan -->
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="fw-bold mb-0">TOTAL</h5>
                            <h5 class="fw-bold mb-0 text-primary" id="totalHargaLayout">Rp 0</h5>
                        </div>
                        <button class="btn btn-success w-100 mb-2 fw-bold" data-bs-toggle="modal"
                            data-bs-target="#modalPembayaran" onclick="siapkanModal()">
                            Proses Pembayaran
                        </button>
                        <button class="btn btn-outline-danger w-100 border-dashed"
                            onclick="kosongkanPesanan()">Kosongkan Pesanan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalPembayaran" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title text-light">Konfirmasi Transaksi</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">Customer:</span>
                            <strong id="displayNamaCustomer">-</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Pembayaran:</span>
                            <strong id="displayMetodeBayar" class="text-uppercase">-</strong>
                        </div>

                        <hr>

                        <ul class="list-unstyled mb-3 small" id="listPesananModal"></ul>

                        <hr>

                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="fw-bold mb-0">Total Tagihan</h5>
                            <h5 class="fw-bold mb-0 text-primary" id="totalTagihanModal">Rp 0</h5>
                        </div>

                        <div id="areaFormCash">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Uang Diterima (Rp)</label>
                                <input type="number" class="form-control form-control-lg" id="inputUangBayar"
                                    oninput="hitungKembalian()" placeholder="0">
                            </div>
                            <div class="d-flex justify-content-between bg-light p-3 border rounded">
                                <h6 class="mb-0 fw-bold">Kembalian</h6>
                                <h6 class="mb-0 fw-bold text-success" id="displayKembalian">Rp 0</h6>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success fw-bold" onclick="prosesTransaksi()">Simpan
                            Transaksi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let keranjang = {};
        let totalTagihanGlobal = 0;

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(angka);
        }

        function filterKategori(idKategori) {
            let items = document.querySelectorAll('.menu-item');
            items.forEach(item => {
                if (idKategori === 'semua') {
                    item.style.display = 'block';
                } else {
                    if (item.getAttribute('data-kategori') == idKategori) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                }
            });
        }

        function tambahKeKeranjang(id, nama, harga) {
            if (keranjang[id]) {
                keranjang[id].qty += 1;
            } else {
                keranjang[id] = {
                    nama: nama,
                    harga: harga,
                    qty: 1
                };
            }
            renderKeranjang();
        }

        function ubahQty(id, aksi) {
            if (aksi === 'tambah') {
                keranjang[id].qty += 1;
            } else if (aksi === 'kurang') {
                keranjang[id].qty -= 1;
                if (keranjang[id].qty === 0) {
                    delete keranjang[id];
                }
            }
            renderKeranjang();
        }

        function renderKeranjang() {
            let htmlPesanan = '';
            totalTagihanGlobal = 0;
            let countItem = 0;

            for (const [id, item] of Object.entries(keranjang)) {
                totalTagihanGlobal += (item.harga * item.qty);
                countItem++;
                htmlPesanan += `
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                    <div>
                        <h6 class="mb-0 text-sm">${item.nama}</h6>
                        <small class="text-muted">${formatRupiah(item.harga)}</small>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <button class="btn btn-sm btn-outline-secondary px-2 py-0" onclick="ubahQty(${id}, 'kurang')">-</button>
                        <span class="fw-bold">${item.qty}</span>
                        <button class="btn btn-sm btn-outline-secondary px-2 py-0" onclick="ubahQty(${id}, 'tambah')">+</button>
                    </div>
                </div>
            `;
            }

            if (countItem === 0) {
                htmlPesanan =
                    `<div class="text-center text-muted p-3" style="border: 2px dashed #ccc;">Belum ada item dipilih</div>`;
            }

            document.getElementById('daftarPesanan').innerHTML = htmlPesanan;
            document.getElementById('totalHargaLayout').innerText = formatRupiah(totalTagihanGlobal);
        }

        // INI ADALAH FUNGSI MODAL YANG SUDAH DIPERBAIKI
        function siapkanModal() {
            if (totalTagihanGlobal === 0) {
                alert('Keranjang masih kosong!');
                event.stopPropagation();
                return;
            }

            let nama = document.getElementById('inputNamaCustomer').value;
            let selectElement = document.getElementById('inputMetodeBayar');
            let metode = selectElement.options[selectElement.selectedIndex].getAttribute('data-nama');

            document.getElementById('displayNamaCustomer').innerText = nama ? nama : 'Umum (Tanpa Nama)';
            document.getElementById('displayMetodeBayar').innerText = metode;

            let htmlListModal = '';
            for (const [id, item] of Object.entries(keranjang)) {
                let subtotal = item.harga * item.qty;

                // Kodingan ini yang akan membuat harga per-item muncul
                htmlListModal += `
                <li class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                    <div>
                        <span class="fw-bold">${item.qty}x ${item.nama}</span><br>
                        <small class="text-muted">@ ${formatRupiah(item.harga)}</small>
                    </div>
                    <span class="fw-bold">${formatRupiah(subtotal)}</span>
                </li>
            `;
            }
            document.getElementById('listPesananModal').innerHTML = htmlListModal;
            document.getElementById('totalTagihanModal').innerText = formatRupiah(totalTagihanGlobal);

            // Kodingan ini yang mengatur form Cash hilang/muncul
            let areaCash = document.getElementById('areaFormCash');
            let inputBayar = document.getElementById('inputUangBayar');

            if (metode.includes('cash') || metode.includes('tunai')) {
                areaCash.classList.remove('d-none'); // Munculkan jika cash
                areaCash.style.display = 'block';
                inputBayar.value = '';
                document.getElementById('displayKembalian').innerText = 'Rp 0';
            } else {
                areaCash.classList.add('d-none'); // Sembunyikan jika qris/transfer
                areaCash.style.display = 'none';
            }
        }

        function hitungKembalian() {
            let uangDiterima = document.getElementById('inputUangBayar').value;
            let kembalian = uangDiterima - totalTagihanGlobal;
            let textKembalian = document.getElementById('displayKembalian');

            if (kembalian >= 0) {
                textKembalian.innerText = formatRupiah(kembalian);
                textKembalian.className = 'mb-0 fw-bold text-success';
            } else {
                textKembalian.innerText = 'Uang Kurang!';
                textKembalian.className = 'mb-0 fw-bold text-danger';
            }
        }

        function kosongkanPesanan() {
            keranjang = {};
            document.getElementById('inputNamaCustomer').value = '';
            renderKeranjang();
        }

        function prosesTransaksi() {
            if (Object.keys(keranjang).length === 0) {
                alert("Keranjang masih kosong!");
                return;
            }

            let selectElement = document.getElementById('inputMetodeBayar');
            let metodeId = selectElement.value;
            let namaCustomer = document.getElementById('inputNamaCustomer').value;
            let uangBayar = parseInt(document.getElementById('inputUangBayar').value) || 0;

            // Konversi object keranjang ke format array
            let cartArray = [];
            let totalQty = 0;

            for (const [id, item] of Object.entries(keranjang)) {
                cartArray.push({
                    menu_id: id,
                    qty: item.qty,
                    harga_satuan: item.harga,
                    subtotal: item.harga * item.qty
                });
                totalQty += item.qty;
            }

            let kembalian = uangBayar - totalTagihanGlobal;

            // Validasi bayar kurang jika menggunakan Tunai/Cash
            let metodeNama = selectElement.options[selectElement.selectedIndex].getAttribute('data-nama') || '';
            if ((metodeNama.includes('cash') || metodeNama.includes('tunai')) && kembalian < 0) {
                alert("Uang pembayaran kurang!");
                return;
            }

            let dataTransaksi = {
                metode_pembayaran_id: metodeId,
                nama_customer: namaCustomer,
                total_qty: totalQty,
                subtotal: totalTagihanGlobal,
                bayar: (metodeNama.includes('cash') || metodeNama.includes('tunai')) ? uangBayar : totalTagihanGlobal,
                kembalian: kembalian >= 0 ? kembalian : 0,
                cart: cartArray
            };

            // Ubah teks tombol jadi loading
            let btnSimpan = document.querySelector('button.btn-success.fw-bold');
            let textAsli = btnSimpan.innerHTML;
            btnSimpan.innerHTML = "Memproses...";
            btnSimpan.disabled = true;

            fetch('{{ route('pos.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json', // <--- TAMBAHKAN BARIS INI
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(dataTransaksi)
                })
                // ... (kodingan fetch di atasnya tetap sama)
                .then(response => {
                    if (!response.ok && response.status !== 422) {
                        throw new Error('Server error ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status === 'success') {
                        // SweetAlert untuk Sukses
                        Swal.fire({
                            icon: 'success',
                            title: 'Transaksi Berhasil!',
                            html: `${data.message} <br> <strong>Nomor Struk: ${data.kode}</strong>`,
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'OK, Lanjut'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload(); // Halaman baru di-refresh SETELAH kasir klik OK
                            }
                        });
                    } else {
                        // SweetAlert untuk Gagal Validasi / Error Controller
                        Swal.fire({
                            icon: 'error',
                            title: 'Transaksi Gagal',
                            text: data.message,
                            confirmButtonColor: '#dc3545',
                        });
                        btnSimpan.innerHTML = textAsli;
                        btnSimpan.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error lengkapnya:', error);
                    // SweetAlert untuk Error Sistem (Mati lampu, server down, dll)
                    Swal.fire({
                        icon: 'error',
                        title: 'Sistem Error!',
                        text: 'Terjadi kesalahan jaringan atau server. Cek console untuk detailnya.',
                        confirmButtonColor: '#dc3545',
                    });
                    btnSimpan.innerHTML = textAsli;
                    btnSimpan.disabled = false;
                });
        }
    </script>
</x-template>
<style>
    .pos-card {
        transition: all 0.2s ease-in-out;
    }

    .pos-card:hover {
        transform: translateY(-4px);
        /* Mengangkat kartu sedikit ke atas */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1) !important;
        /* Mempertebal bayangan */
        border-color: #0d6efd !important;
        /* Memberikan garis pinggir biru saat di-hover */
    }
</style>
