@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-edit"></i> Edit Pelanggan</h4>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-light">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card-body">
            <!-- Pesan Error -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Kode Pelanggan</label>
                    <input type="text" name="kode_pelanggan" class="form-control" value="{{ old('kode_pelanggan', $pelanggan->kode_pelanggan) }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $pelanggan->nama) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">No. Telepon</label>
                    <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $pelanggan->no_telp) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $pelanggan->email) }}" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save"></i> Simpan Perubahan
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

    .form-label {
        font-weight: bold;
    }

    .btn-warning {
        font-size: 16px;
    }
</style>
@endsection
