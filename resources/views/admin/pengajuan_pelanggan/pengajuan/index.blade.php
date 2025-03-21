@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Pengajuan Barang Pelanggan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('pengajuan.create') }}" class="btn btn-primary mb-3">Ajukan Barang</a>

    <table class="table">
        <thead>
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
                    <td>{{ ucfirst($p->status) }}</td>
                    <td>{{ $p->tanggal_pengajuan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
