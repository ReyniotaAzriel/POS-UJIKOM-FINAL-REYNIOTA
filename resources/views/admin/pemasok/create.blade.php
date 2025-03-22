@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0"><i class="fas fa-user-plus"></i> Tambah Pemasok</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pemasok.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_pemasok" class="form-label">Nama Pemasok</label>
                                <input type="text" name="nama_pemasok" id="nama_pemasok"
                                    class="form-control @error('nama_pemasok') is-invalid @enderror"
                                    placeholder="Masukkan nama pemasok" required>
                                @error('nama_pemasok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukkan alamat"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                                <input type="text" name="nomor_telepon" id="nomor_telepon" class="form-control"
                                    placeholder="Masukkan nomor telepon">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Masukkan email">
                            </div>

                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <textarea name="catatan" id="catatan" class="form-control" placeholder="Masukkan catatan"></textarea>
                            </div>

                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('pemasok.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan Pemasok
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Styling untuk form */
        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        /* Hover tombol */
        .btn:hover {
            opacity: 0.9;
        }
    </style>
@endsection
