@extends('layouts.pemilik')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Laporan Pelanggan</h2>

        <!-- Filter Form -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('laporan.pelanggan') }}" method="GET">
                    <div class="row">
                        <!-- Input Nama Pelanggan -->
                        <div class="col-md-8">
                            <label for="nama" class="form-label">Nama Pelanggan</label>
                            <input type="text" name="nama" id="nama" class="form-control"
                                value="{{ request('nama') }}" placeholder="Cari Nama Pelanggan">
                        </div>

                        <!-- Tombol Filter -->
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Laporan Pelanggan -->
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Kode Pelanggan</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No. Telepon</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pelanggans as $index => $pelanggan)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $pelanggan->kode_pelanggan }}</td>
                                <td>{{ $pelanggan->nama }}</td>
                                <td>{{ $pelanggan->alamat }}</td>
                                <td>{{ $pelanggan->no_telp }}</td>
                                <td>{{ $pelanggan->email }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Tidak ada data pelanggan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
