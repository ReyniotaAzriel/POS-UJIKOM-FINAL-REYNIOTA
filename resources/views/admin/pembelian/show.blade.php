@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-receipt"></i> Detail Pembelian</h4>
                <a href="{{ route('pembelian.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5><i class="fas fa-barcode"></i> Kode Masuk:</h5>
                        <p class="fw-bold">{{ $pembelian->kode_masuk }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5><i class="fas fa-calendar-alt"></i> Tanggal Masuk:</h5>
                        <p>{{ \Carbon\Carbon::parse($pembelian->tanggal_masuk)->format('d M Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5><i class="fas fa-truck"></i> Pemasok:</h5>
                        <p>{{ $pembelian->pemasok->nama_pemasok }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5><i class="fas fa-user"></i> User:</h5>
                        <p>{{ $pembelian->user->name }}</p>
                    </div>
                    <div class="col-md-12">
                        <h5 class="text-success"><i class="fas fa-money-bill-wave"></i> Total:</h5>
                        <p class="fs-4 fw-bold text-success">Rp {{ number_format($pembelian->total, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-4"><i class="fas fa-boxes"></i> Detail Barang</h3>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th><i class="fas fa-box"></i> Nama Barang</th>
                            <th><i class="fas fa-tag"></i> Harga Beli</th>
                            <th><i class="fas fa-sort-numeric-up"></i> Jumlah</th>
                            <th><i class="fas fa-dollar-sign"></i> Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembelian->detailPembelian as $index => $detail)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $detail->barang->nama_barang }}</td>
                                <td>Rp {{ number_format($detail->harga_beli, 0, ',', '.') }}</td>
                                <td>{{ $detail->jumlah }}</td>
                                <td class="fw-bold text-primary">Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 8px;
        }

        .fw-bold {
            font-weight: bold;
        }

        .fs-4 {
            font-size: 1.5rem;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        .table-dark th {
            text-align: center;
        }

        .table th, .table td {
            text-align: center;
        }
    </style>
@endsection
