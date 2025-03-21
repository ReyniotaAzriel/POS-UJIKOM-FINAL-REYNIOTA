@extends('layouts.pemilik')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Laporan Penjualan</h2>

        <!-- Filter Form -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('laporan.penjualan') }}" method="GET">
                    <div class="row">
                        <!-- Input Tanggal -->
                        <div class="col-md-5">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control"
                                value="{{ request('tanggal') }}">
                        </div>

                        <!-- Input Pelanggan -->
                        <div class="col-md-5">
                            <label for="pelanggan" class="form-label">Nama Pelanggan</label>
                            <input type="text" name="pelanggan" id="pelanggan" class="form-control"
                                value="{{ request('pelanggan') }}" placeholder="Cari Nama Pelanggan">
                        </div>

                        <!-- Tombol Filter -->
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Laporan Penjualan -->
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th>No</th>
                            <th>No Faktur</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Total Bayar</th>
                            <th>User</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penjualans as $penjualan)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $penjualan->no_faktur }}</td>
                                <td>{{ $penjualan->tgl_faktur }}</td>
                                <td>{{ $penjualan->pelanggan->nama ?? '-' }}</td>
                                <td>Rp {{ number_format($penjualan->total_bayar, 0, ',', '.') }}</td>
                                <td>{{ $penjualan->user->name ?? '-' }}</td>
                                <td><a href="{{ route('laporan.show.penjualan', $penjualan->id) }}">Lihat Detail</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Tidak ada data penjualan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
