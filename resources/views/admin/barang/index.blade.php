@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h4 class="mb-3">Manajemen Barang</h4>

        {{-- Tombol Menuju Halaman Tambah Barang --}}
        <a href="{{ route('barang.create') }}" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> Tambah Barang
        </a>

        {{-- Tabel Daftar Barang --}}
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Daftar Barang</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Satuan</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Gambar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangs as $barang)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $barang->kode_barang }}</td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>{{ $barang->kategori ? $barang->kategori->nama_kategori : '-' }}</td>
                                    <td>{{ $barang->satuan }}</td>
                                    <td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                                    <td>{{ $barang->stok }}</td>
                                    <td class="text-center">
                                        @if ($barang->gambar)
                                            <img src="{{ asset('file/produk/' . $barang->gambar) }}" width="80"
                                                class="rounded img-thumbnail hover-zoom" alt="Gambar Barang">
                                        @else
                                            <span class="text-muted">Tidak Ada</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning btn-sm me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus barang ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> {{-- End Table Responsive --}}
            </div>
        </div>
    </div>

    <style>
        /* Animasi Hover Gambar */
        .hover-zoom {
            transition: transform 0.3s ease-in-out;
        }

        .hover-zoom:hover {
            transform: scale(1.1);
        }

        /* Tombol Efek Hover */
        .btn:hover {
            opacity: 0.9;
        }
    </style>
@endsection
