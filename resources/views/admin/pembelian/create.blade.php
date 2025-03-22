@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-plus-circle"></i> Tambah Pembelian</h4>
                <a href="{{ route('pembelian.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('pembelian.store') }}" method="POST">
                    @csrf

                    {{-- Tanggal Masuk --}}
                    <div class="mb-3">
                        <label for="tanggal_masuk" class="form-label"><i class="fas fa-calendar-alt"></i> Tanggal Masuk</label>
                        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" required>
                    </div>

                    {{-- Pemasok --}}
                    <div class="mb-3">
                        <label for="pemasok_id" class="form-label"><i class="fas fa-truck"></i> Pemasok</label>
                        <select class="form-control" id="pemasok_id" name="pemasok_id" required>
                            <option value="">Pilih Pemasok</option>
                            @foreach ($pemasoks as $pemasok)
                                <option value="{{ $pemasok->id }}">{{ $pemasok->nama_pemasok }}</option>
                            @endforeach
                        </select>
                    </div>

                    <h4 class="mt-4"><i class="fas fa-box"></i> Detail Barang</h4>
                    <div id="barang-container">
                        <div class="row mb-2 barang-row">
                            <div class="col-md-4">
                                <label>Barang</label>
                                <select name="barang_id[]" class="form-control barang-select" required>
                                    <option value="">Pilih Barang</option>
                                    @foreach ($barangs as $barang)
                                        <option value="{{ $barang->id }}" data-harga="{{ $barang->harga_jual }}">
                                            {{ $barang->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Harga Beli</label>
                                <input type="number" name="harga_beli[]" class="form-control harga-beli" required>
                            </div>
                            <div class="col-md-3">
                                <label>Jumlah</label>
                                <input type="number" name="jumlah[]" class="form-control jumlah" required>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-danger remove-barang"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    </div>

                    <button type="button" id="add-barang" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah Barang
                    </button>

                    {{-- Total Harga --}}
                    <div class="mb-3 mt-3">
                        <label for="total" class="form-label"><i class="fas fa-dollar-sign"></i> Total</label>
                        <input type="number" class="form-control" id="total" name="total" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-barang').addEventListener('click', function() {
            let container = document.getElementById('barang-container');
            let row = document.createElement('div');
            row.classList.add('row', 'mb-2', 'barang-row');
            row.innerHTML = `
                <div class="col-md-4">
                    <select name="barang_id[]" class="form-control barang-select" required>
                        <option value="">Pilih Barang</option>
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}" data-harga="{{ $barang->harga_jual }}">{{ $barang->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" name="harga_beli[]" class="form-control harga-beli" required>
                </div>
                <div class="col-md-3">
                    <input type="number" name="jumlah[]" class="form-control jumlah" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-barang"><i class="fas fa-trash"></i></button>
                </div>
            `;
            container.appendChild(row);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-barang')) {
                e.target.closest('.barang-row').remove();
                hitungTotal();
            }
        });

        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('harga-beli') || e.target.classList.contains('jumlah')) {
                hitungTotal();
            }
        });

        function hitungTotal() {
            let total = 0;
            document.querySelectorAll('.barang-row').forEach(row => {
                let harga = row.querySelector('.harga-beli').value || 0;
                let jumlah = row.querySelector('.jumlah').value || 0;
                total += (parseFloat(harga) * parseFloat(jumlah));
            });
            document.getElementById('total').value = total;
        }
    </script>

    <style>
        /* Styling Card */
        .card {
            border-radius: 8px;
        }

        /* Styling Form */
        .form-control {
            border-radius: 5px;
        }

        /* Styling Buttons */
        .btn {
            border-radius: 5px;
        }

        .btn:hover {
            opacity: 0.9;
        }

        /* Styling Total */
        #total {
            font-weight: bold;
            background-color: #f8f9fa;
        }
    </style>
@endsection
