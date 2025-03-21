@extends('layouts.pemilik')

@section('content')
    <div class="container">
        <h2>Detail Penjualan: {{ $penjualan->no_faktur }}</h2>
        <p>Tanggal: {{ $penjualan->tgl_faktur }}</p>
        <p>Total Bayar: Rp {{ number_format($penjualan->total_bayar, 0, ',', '.') }}</p>
        <p>Pelanggan: {{ $penjualan->pelanggan->nama ?? '-' }}</p>

        <h3>Detail Barang</h3>
        <table border="1">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Harga Jual</th>
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
    </div>
@endsection
