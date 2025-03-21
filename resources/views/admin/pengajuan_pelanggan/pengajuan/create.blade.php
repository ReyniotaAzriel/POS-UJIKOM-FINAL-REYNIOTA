@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Ajukan Barang Baru</h2>

    <form action="{{ route('pengajuan.index') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="pelanggan_id">Pelanggan</label>
            <select name="pelanggan_id" id="pelanggan_id" class="form-control" required>
                <option value="">Pilih Pelanggan</option>
                @foreach($pelanggan as $p)
                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="barang_id">Pilih Barang (Jika Sudah Ada)</label>
            <select name="barang_id" id="barang_id" class="form-control">
                <option value="">-- Barang Baru --</option>
                @foreach($barang as $b)
                    <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
                @endforeach
            </select>
        </div>

        <div id="barang-baru">
            <div class="form-group">
                <label for="nama_barang">Nama Barang Baru</label>
                <input type="text" name="nama_barang" id="nama_barang" class="form-control">
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Barang</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="qty">Jumlah</label>
            <input type="number" name="qty" id="qty" class="form-control" min="1" required>
        </div>

        <div class="form-group">
            <label for="tanggal_pengajuan">Tanggal Pengajuan</label>
            <input type="date" name="tanggal_pengajuan" id="tanggal_pengajuan" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajukan</button>
    </form>
</div>

<script>
    document.getElementById("barang_id").addEventListener("change", function() {
        document.getElementById("barang-baru").style.display = this.value ? "none" : "block";
    });
</script>
@endsection
