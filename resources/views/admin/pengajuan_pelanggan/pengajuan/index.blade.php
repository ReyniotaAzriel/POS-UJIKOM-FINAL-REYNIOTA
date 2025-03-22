@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-box"></i> Pengajuan Barang Pelanggan</h4>
            <a href="{{ route('pengajuan.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-plus"></i> Ajukan Barang
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> <strong>Berhasil!</strong> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Pelanggan</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengajuan as $p)
                            <tr>
                                <td>{{ $p->pelanggan->nama }}</td>
                                <td>{{ $p->barang ? $p->barang->nama_barang : $p->nama_barang }}</td>
                                <td>{{ $p->qty }}</td>
                                <td>
                                    <span class="badge badge-{{ $p->status == 'disetujui' ? 'success' : ($p->status == 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($p->tanggal_pengajuan)->format('d M Y') }}</td>
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

    .table thead {
        background-color: #343a40;
        color: white;
    }

    .badge {
        font-size: 14px;
        padding: 5px 10px;
        color: black
    }

    .alert {
        animation: fadeIn 0.5s;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
