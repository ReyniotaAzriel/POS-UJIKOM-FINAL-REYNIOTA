@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h4 class="mb-3">Tambah Barang</h4>

        {{-- Form Tambah Barang --}}
        <div class="card">
            <div class="card-body">
                <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-control" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="form-label">Satuan</label>
                            <select name="satuan" class="form-control" required>
                                <option value="" disabled selected>Pilih Satuan</option>
                                <option value="pcs">Pcs</option>
                                <option value="dus">Dus</option>
                                <option value="kg">Kg</option>
                                <option value="liter">Liter</option>
                                <option value="pack">Pack</option>
                            </select>
                        </div>
                        <div class="col-md-12 mt-2">
                            <label class="form-label">Upload Gambar</label>
                            <input type="file" name="gambar" class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    <a href="{{ route('barang.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
