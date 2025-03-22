@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0"><i class="fas fa-user-tie"></i> Detail Pemasok</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <tbody>
                                <tr>
                                    <th class="bg-light">Nama Pemasok</th>
                                    <td>{{ $pemasok->nama_pemasok }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Alamat</th>
                                    <td>{{ $pemasok->alamat ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Nomor Telepon</th>
                                    <td>{{ $pemasok->nomor_telepon ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Email</th>
                                    <td>{{ $pemasok->email ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Catatan</th>
                                    <td>{{ $pemasok->catatan ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('pemasok.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            {{--  <a href="{{ route('pemasok.edit', $pemasok->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>  --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Styling untuk tabel */
        .table th {
            width: 30%;
            font-weight: bold;
            text-align: left;
            background-color: #f8f9fa;
        }

        .table td {
            text-align: left;
        }

        /* Efek hover pada tabel */
        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        /* Hover tombol */
        .btn:hover {
            opacity: 0.9;
        }
    </style>
@endsection
