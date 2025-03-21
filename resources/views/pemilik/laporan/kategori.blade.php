@extends('layouts.pemilik')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Laporan Kategori</h2>

        <!-- Filter Form -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('laporan.kategori') }}" method="GET">
                    <div class="row">
                        <!-- Input Nama Kategori -->
                        <div class="col-md-8">
                            <label for="nama_kategori" class="form-label">Nama Kategori</label>
                            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control"
                                value="{{ request('nama_kategori') }}" placeholder="Cari Nama Kategori">
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

        <!-- Tabel Laporan Kategori -->
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategoris as $index => $kategori)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $kategori->nama_kategori }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center text-muted">Tidak ada data kategori.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
