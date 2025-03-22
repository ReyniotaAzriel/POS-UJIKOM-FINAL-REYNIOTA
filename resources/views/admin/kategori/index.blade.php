@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <!-- Card Tambah Kategori -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title mb-0">Tambah Kategori</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kategori.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                <input type="text" name="nama_kategori" id="nama_kategori"
                                    class="form-control @error('nama_kategori') is-invalid @enderror"
                                    placeholder="Masukkan nama kategori" required>
                                @error('nama_kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-plus"></i> Tambah Kategori
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Card Daftar Kategori -->
                <div class="card mt-4 shadow-sm border-0">
                    <div class="card-header bg-success text-white">
                        <h4 class="card-title mb-0">Daftar Kategori</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Kategori</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategoris as $kategori)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kategori->nama_kategori }}</td>
                                        <td class="text-center">
                                            <!-- Tombol Edit -->
                                            <button type="button" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $kategori->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editModal{{ $kategori->id }}" tabindex="-1"
                                        aria-labelledby="editModalLabel{{ $kategori->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning text-dark">
                                                    <h5 class="modal-title" id="editModalLabel{{ $kategori->id }}">
                                                        Edit Kategori
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('kategori.update', $kategori->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="mb-3">
                                                            <label for="edit_nama_kategori{{ $kategori->id }}"
                                                                class="form-label">Nama Kategori</label>
                                                            <input type="text" name="nama_kategori"
                                                                id="edit_nama_kategori{{ $kategori->id }}"
                                                                class="form-control" value="{{ $kategori->nama_kategori }}"
                                                                required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary w-100">
                                                            <i class="fas fa-save"></i> Simpan Perubahan
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                @endforeach
                            </tbody>
                        </table>
                        @if (session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        /* Efek hover tombol */
        .btn:hover {
            opacity: 0.9;
        }

        /* Tabel */
        table th, table td {
            vertical-align: middle;
        }
    </style>
@endsection
