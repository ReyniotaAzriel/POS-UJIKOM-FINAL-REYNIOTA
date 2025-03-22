@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h4 class="mb-3">Edit Barang</h4>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0"><i class="fas fa-edit"></i> Form Edit Barang</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('barang.index') }}" class="btn btn-secondary mb-3">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="row g-3">
                        {{-- Kode Barang --}}
                        <div class="col-md-6">
                            <label class="form-label">Kode Barang</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                <input type="text" class="form-control" name="kode_barang"
                                    value="{{ old('kode_barang', $barang->kode_barang) }}" required>
                            </div>
                        </div>

                        {{-- Nama Barang --}}
                        <div class="col-md-6">
                            <label class="form-label">Nama Barang</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-box"></i></span>
                                <input type="text" class="form-control" name="nama_barang"
                                    value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                            </div>
                        </div>

                        {{-- Satuan --}}
                        <div class="col-md-6">
                            <label class="form-label">Satuan</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-balance-scale"></i></span>
                                <input type="text" class="form-control" name="satuan"
                                    value="{{ old('satuan', $barang->satuan) }}" required>
                            </div>
                        </div>

                        {{-- Harga Jual --}}
                        <div class="col-md-6">
                            <label class="form-label">Harga Jual</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                                <input type="number" class="form-control" name="harga_jual"
                                    value="{{ old('harga_jual', $barang->harga_jual) }}" required>
                            </div>
                        </div>

                        {{-- Stok --}}
                        <div class="col-md-6">
                            <label class="form-label">Stok</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                <input type="number" class="form-control" name="stok"
                                    value="{{ old('stok', $barang->stok) }}" required>
                            </div>
                        </div>

                        {{-- Kategori --}}
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-list"></i></span>
                                <select class="form-select" name="kategori_id" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}"
                                            {{ $barang->kategori_id == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Gambar Barang --}}
                        <div class="col-md-6">
                            <label class="form-label">Gambar Barang</label>
                            <input type="file" class="form-control" id="gambarUpload" name="gambar"
                                onchange="previewImage(event)">
                        </div>

                        {{-- Preview Gambar --}}
                        <div class="col-md-6 text-center">
                            @if ($barang->gambar)
                                <img src="{{ asset('file/produk/' . $barang->gambar) }}" id="gambarPreview"
                                    class="img-thumbnail" width="150">
                            @else
                                <img id="gambarPreview" class="img-thumbnail d-none" width="150">
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Efek hover tombol */
        .btn:hover {
            opacity: 0.9;
        }

        /* Efek animasi preview gambar */
        #gambarPreview {
            transition: transform 0.3s ease-in-out;
        }

        #gambarPreview:hover {
            transform: scale(1.1);
        }
    </style>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('gambarPreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
