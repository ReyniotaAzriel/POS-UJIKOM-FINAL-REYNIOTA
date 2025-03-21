@extends('layouts.pemilik')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Laporan Pembelian</h2>

        <!-- Filter Form -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('laporan.pembelian') }}" method="GET">
                    <div class="row">
                        <!-- Input Tanggal -->
                        <div class="col-md-5">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control"
                                value="{{ request('tanggal') }}">
                        </div>

                        <!-- Input Pemasok -->
                        <div class="col-md-5">
                            <label for="pemasok" class="form-label">Nama Pemasok</label>
                            <input type="text" name="pemasok" id="pemasok" class="form-control"
                                value="{{ request('pemasok') }}" placeholder="Cari Nama Pemasok">
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

        <!-- Tabel Laporan Pembelian -->
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Kode Masuk</th>
                            <th>Tanggal</th>
                            <th>Pemasok</th>
                            <th>Total</th>
                            <th>User</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pembelians as $pembelian)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $pembelian->kode_masuk }}</td>
                                <td>{{ $pembelian->tanggal_masuk }}</td>
                                <td>{{ $pembelian->pemasok->nama_pemasok ?? '-' }}</td>
                                <td>Rp {{ number_format($pembelian->total, 0, ',', '.') }}</td>
                                <td>{{ $pembelian->user->name ?? '-' }}</td>
                                <td><a href="{{ route('laporan.show.pembelian', $pembelian->id) }}">Lihat Detail</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Tidak ada data pembelian.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
