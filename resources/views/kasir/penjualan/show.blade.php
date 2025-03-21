@extends('layouts.kasir')

@section('content')
    <div class="container">
        <h2 class="mb-4">Detail Penjualan</h2>

        <table class="table">
            <tr>
                <th>No Faktur</th>
                <td>{{ $penjualan->no_faktur }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>{{ $penjualan->tgl_faktur }}</td>
            </tr>
            <tr>
                <th>Pelanggan</th>
                <td>{{ $penjualan->pelanggan->nama ?? 'Umum' }}</td>
            </tr>
            <tr>
                <th>Total Bayar</th>
                <td>Rp {{ number_format($penjualan->total_bayar, 0, ',', '.') }}</td>
            </tr>
        </table>

        <h4>Detail Barang</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualan->detailPenjualan as $detail)
                    <tr>
                        <td>{{ $detail->barang->nama_barang }}</td>
                        <td>Rp {{ number_format($detail->harga_jual, 0, ',', '.') }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
