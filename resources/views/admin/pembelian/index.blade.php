@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-shopping-cart"></i> Daftar Pembelian</h4>
                <a href="{{ route('pembelian.create') }}" class="btn btn-light">
                    <i class="fas fa-plus"></i> Tambah Pembelian
                </a>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Kode Masuk</th>
                                <th>Tanggal Masuk</th>
                                <th>Pemasok</th>
                                <th>User</th>
                                <th>Total</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembelians as $index => $pembelian)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $pembelian->kode_masuk }}</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($pembelian->tanggal_masuk)->format('d M Y') }}</td>
                                    <td>{{ $pembelian->pemasok->nama_pemasok }}</td>
                                    <td>{{ $pembelian->user->name }}</td>
                                    <td>Rp {{ number_format($pembelian->total, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('pembelian.show', $pembelian->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Styling tabel */
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Styling tombol */
        .btn:hover {
            opacity: 0.9;
        }
    </style>
@endsection
