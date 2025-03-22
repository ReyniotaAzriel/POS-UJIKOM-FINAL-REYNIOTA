@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-users"></i> Daftar Pelanggan</h4>
            <a href="{{ route('pelanggan.create') }}" class="btn btn-light">
                <i class="fas fa-plus"></i> Tambah Pelanggan
            </a>
        </div>

        <div class="card-body">
            <!-- Pesan Sukses -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="fas fa-barcode"></i> Kode</th>
                            <th><i class="fas fa-user"></i> Nama</th>
                            <th><i class="fas fa-map-marker-alt"></i> Alamat</th>
                            <th><i class="fas fa-phone"></i> No. Telepon</th>
                            <th><i class="fas fa-envelope"></i> Email</th>
                            <th><i class="fas fa-cogs"></i> Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pelanggan as $p)
                            <tr>
                                <td>{{ $p->kode_pelanggan }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->alamat }}</td>
                                <td>{{ $p->no_telp }}</td>
                                <td>{{ $p->email }}</td>
                                <td class="text-center">
                                    
                                    <a href="{{ route('pelanggan.edit', $p->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
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
    .card {
        border-radius: 8px;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .table-dark th {
        text-align: center;
    }

    .table th, .table td {
        text-align: center;
        vertical-align: middle;
    }

    .btn-sm {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endsection
