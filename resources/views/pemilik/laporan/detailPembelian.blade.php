@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Pembelian: {{ $pembelian->kode_masuk }}</h2>

        <p><strong>Tanggal:</strong> {{ $pembelian->tanggal_masuk }}</p>
        <p><strong>Total:</strong> Rp {{ number_format($pembelian->total, 0, ',', '.') }}</p>
        <p><strong>Pemasok:</strong> {{ $pembelian->pemasok->nama ?? '-' }}</p>
        <p><strong>Petugas:</strong> {{ $pembelian->user->name ?? '-' }}</p>

        <h3>Detail Barang</h3>
        <table border="1">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Harga Beli</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembelian->detailPembelian as $detail)
                    <tr>
                        <td>{{ $detail->barang->nama_barang }}</td>
                        <td>Rp {{ number_format($detail->harga_beli, 0, ',', '.') }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('laporan.pembelian.index') }}">Kembali ke Laporan Pembelian</a>
    </div>
@endsection
