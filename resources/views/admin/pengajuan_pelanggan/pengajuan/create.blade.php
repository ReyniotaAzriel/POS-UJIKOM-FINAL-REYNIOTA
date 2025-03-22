@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-plus-circle"></i> Ajukan Barang Baru</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('pengajuan.index') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="pelanggan_id" class="form-label">Pelanggan</label>
                    <select name="pelanggan_id" id="pelanggan_id" class="form-control select2" required>
                        <option value="">Pilih Pelanggan</option>
                        @foreach($pelanggan as $p)
                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="barang_id" class="form-label">Pilih Barang (Jika Sudah Ada)</label>
                    <select name="barang_id" id="barang_id" class="form-control select2">
                        <option value="">-- Barang Baru --</option>
                        @foreach($barang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="barang-baru">
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang Baru</label>
                        <input type="text" name="nama_barang" id="nama_barang" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi Barang</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="qty" class="form-label">Jumlah</label>
                    <input type="number" name="qty" id="qty" class="form-control" min="1" required>
                </div>

                <div class="mb-3">
                    <label for="tanggal_pengajuan" class="form-label">Tanggal Pengajuan</label>
                    <input type="date" name="tanggal_pengajuan" id="tanggal_pengajuan" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-paper-plane"></i> Ajukan
                </button>
                <a href="{{ route('pengajuan.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById("barang_id").addEventListener("change", function() {
        document.getElementById("barang-baru").style.display = this.value ? "none" : "block";
    });
</script>

<style>
    .card {
        border-radius: 8px;
    }

    .form-label {
        font-weight: 600;
    }

    .btn i {
        margin-right: 5px;
    }

    barang-baru {
        transition: all 0.3s ease-in-out;
    }
</style>
@endsection
