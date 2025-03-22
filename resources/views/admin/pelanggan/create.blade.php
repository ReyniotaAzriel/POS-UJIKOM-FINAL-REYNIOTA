@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-user-plus"></i> Tambah Pelanggan</h4>
        </div>

        <div class="card-body">
            <!-- Pesan Validasi -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> <strong>Terjadi Kesalahan!</strong>
                    <ul class="mt-2 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{ route('pelanggan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label"><i class="fas fa-user"></i> Nama</label>
                    <input type="text" class="form-control input-custom" id="nama" name="nama" value="{{ old('nama') }}" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label"><i class="fas fa-map-marker-alt"></i> Alamat</label>
                    <textarea class="form-control input-custom" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="no_telp" class="form-label"><i class="fas fa-phone"></i> No. Telepon</label>
                    <input type="text" class="form-control input-custom" id="no_telp" name="no_telp" value="{{ old('no_telp') }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" class="form-control input-custom" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary me-2">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 8px;
    }

    .input-custom {
        border-radius: 5px;
        border: 1px solid #ccc;
        transition: all 0.3s;
    }

    .input-custom:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .btn {
        border-radius: 5px;
    }

    .alert ul {
        padding-left: 20px;
    }
</style>
@endsection
