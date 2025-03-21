@extends('layouts.pemilik')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Laporan Pemasok</h2>

        <!-- Filter Form -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('laporan.pemasok') }}" method="GET">
                    <div class="row">
                        <!-- Input Nama Pemasok -->
                        <div class="col-md-8">
                            <label for="nama" class="form-label">Nama Pemasok</label>
                            <input type="text" name="nama" id="nama" class="form-control"
                                value="{{ request('nama') }}" placeholder="Cari Nama Pemasok">
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

        <!-- Tabel Laporan Pemasok -->
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No. Telepon</th>
                            <th>Email</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pemasoks as $index => $pemasok)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $pemasok->nama_pemasok }}</td>
                                <td>{{ $pemasok->alamat }}</td>
                                <td>{{ $pemasok->nomor_telepon }}</td>
                                <td>{{ $pemasok->email }}</td>
                                <td>{{ $pemasok->catatan }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Tidak ada data pemasok.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
