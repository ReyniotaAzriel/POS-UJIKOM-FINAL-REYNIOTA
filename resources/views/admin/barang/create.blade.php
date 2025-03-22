@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h4 class="mb-3">Tambah Barang</h4>

        {{-- Form Tambah Barang --}}
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-box"></i> Form Tambah Barang</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Barang</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                <input type="text" name="nama_barang" class="form-control" placeholder="Masukkan nama barang" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-list"></i></span>
                                <select name="kategori_id" class="form-select" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Satuan</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-balance-scale"></i></span>
                                <select name="satuan" class="form-select" required>
                                    <option value="" disabled selected>Pilih Satuan</option>
                                    <option value="pcs">Pcs</option>
                                    <option value="dus">Dus</option>
                                    <option value="kg">Kg</option>
                                    <option value="liter">Liter</option>
                                    <option value="pack">Pack</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Upload Gambar</label>
                            <input type="file" name="gambar" class="form-control" id="gambarUpload" onchange="previewImage(event)">
                        </div>
                        <div class="col-md-12 text-center mt-2">
                            <img id="gambarPreview" class="img-thumbnail d-none" width="150">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
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
