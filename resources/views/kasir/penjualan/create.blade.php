@extends('layouts.kasir')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm p-4">
            <h2 class="mb-4 text-primary">Tambah Penjualan</h2>

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('penjualan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="pelanggan_id" class="form-label fw-bold">Pelanggan (Opsional)</label>
                    <select name="pelanggan_id" class="form-select">
                        <option value="0">Umum</option>
                        @foreach ($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <h4 class="mt-4 text-secondary">Tambah Barang</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mt-2">
                        <thead class="table-primary">
                            <tr>
                                <th>Barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="keranjang">
                            <!-- Barang akan ditambahkan di sini -->
                        </tbody>
                    </table>
                </div>

                <div class="row align-items-end">
                    <div class="col-md-6">
                        <label for="barang" class="form-label fw-bold">Pilih Barang</label>
                        <select id="barang" class="form-select">
                            <option value="">-- Pilih Barang --</option>
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}" data-harga="{{ $barang->harga_jual }}">
                                    {{ $barang->nama_barang }} - Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}
                                    (Stok:
                                    {{ $barang->stok }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <button type="button" class="btn btn-success w-100" id="tambahBarang">Tambah ke Keranjang</button>
                    </div>
                </div>

                <input type="hidden" name="keranjang_data" id="keranjang_data">
                <button type="submit" class="btn btn-primary mt-4 w-100">Simpan Transaksi</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let keranjang = {};

            document.getElementById('tambahBarang').addEventListener('click', function() {
                let barangSelect = document.getElementById('barang');
                let barangId = barangSelect.value;
                let barangNama = barangSelect.options[barangSelect.selectedIndex].text;
                let barangHarga = parseInt(barangSelect.options[barangSelect.selectedIndex].getAttribute(
                    'data-harga'));

                if (!barangId) {
                    alert('Pilih barang terlebih dahulu!');
                    return;
                }

                if (keranjang[barangId]) {
                    keranjang[barangId].jumlah += 1;
                } else {
                    keranjang[barangId] = {
                        nama: barangNama,
                        harga: barangHarga,
                        jumlah: 1
                    };
                }

                updateKeranjang();
            });

            function updateKeranjang() {
                let tbody = document.getElementById('keranjang');
                tbody.innerHTML = '';

                Object.keys(keranjang).forEach(id => {
                    let item = keranjang[id];
                    let row = `
                        <tr>
                            <td>${item.nama}</td>
                            <td>Rp ${item.harga.toLocaleString()}</td>
                            <td>
                                <input type="number" min="1" value="${item.jumlah}" class="form-control jumlah-barang" data-id="${id}">
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm hapus-barang" data-id="${id}">Hapus</button>
                            </td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                });

                document.getElementById('keranjang_data').value = JSON.stringify(keranjang);

                document.querySelectorAll('.hapus-barang').forEach(button => {
                    button.addEventListener('click', function() {
                        let id = this.getAttribute('data-id');
                        delete keranjang[id];
                        updateKeranjang();
                    });
                });

                document.querySelectorAll('.jumlah-barang').forEach(input => {
                    input.addEventListener('change', function() {
                        let id = this.getAttribute('data-id');
                        keranjang[id].jumlah = parseInt(this.value);
                        updateKeranjang();
                    });
                });
            }
        });
    </script>
@endsection
