@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><i class="fas fa-truck"></i> Manajemen Pemasok</h4>
                        <a href="{{ route('pemasok.create') }}" class="btn btn-light text-primary">
                            <i class="fas fa-plus"></i> Tambah Pemasok
                        </a>
                    </div>

                    <div class="card-body">
                        {{-- Search Bar --}}
                        <div class="mb-3">
                            <input type="text" id="search" class="form-control" placeholder="Cari pemasok...">
                        </div>

                        {{-- Tabel Data --}}
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pemasok</th>
                                        <th>Alamat</th>
                                        <th>Nomor Telepon</th>
                                        <th>Email</th>
                                        <th>Catatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="pemasokTable">
                                    @foreach ($pemasok as $p)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $p->nama_pemasok }}</td>
                                            <td>{{ $p->alamat }}</td>
                                            <td>{{ $p->nomor_telepon }}</td>
                                            <td>{{ $p->email }}</td>
                                            <td>{{ $p->catatan }}</td>
                                            <td>
                                                <a href="{{ route('pemasok.show', $p->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $p->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <form action="{{ route('pemasok.destroy', $p->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus pemasok ini?')"
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
                                        <div class="modal fade" id="editModal{{ $p->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel{{ $p->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning text-white">
                                                        <h5 class="modal-title" id="editModalLabel{{ $p->id }}">
                                                            <i class="fas fa-edit"></i> Edit Pemasok
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('pemasok.update', $p->id) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')

                                                            <div class="mb-3">
                                                                <label class="form-label">Nama Pemasok</label>
                                                                <input type="text" name="nama_pemasok"
                                                                    class="form-control" value="{{ $p->nama_pemasok }}"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Alamat</label>
                                                                <textarea name="alamat" class="form-control">{{ $p->alamat }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Nomor Telepon</label>
                                                                <input type="text" name="nomor_telepon"
                                                                    class="form-control" value="{{ $p->nomor_telepon }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Email</label>
                                                                <input type="email" name="email"
                                                                    class="form-control" value="{{ $p->email }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Catatan</label>
                                                                <textarea name="catatan" class="form-control">{{ $p->catatan }}</textarea>
                                                            </div>

                                                            <div class="d-flex justify-content-between">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="fas fa-times"></i> Batal
                                                                </button>
                                                                <button type="submit" class="btn btn-success">
                                                                    <i class="fas fa-save"></i> Simpan Perubahan
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Notifikasi Berhasil --}}
                        @if (session('success'))
                            <div class="alert alert-success mt-3">
                                <i class="fas fa-check-circle"></i> {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Efek hover tabel */
        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
        }

        /* Efek hover tombol */
        .btn:hover {
            opacity: 0.9;
        }
    </style>

    <script>
        // Live search di tabel pemasok
        document.getElementById('search').addEventListener('input', function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("#pemasokTable tr");

            rows.forEach(row => {
                let nama = row.cells[1].textContent.toLowerCase();
                let alamat = row.cells[2].textContent.toLowerCase();
                let telepon = row.cells[3].textContent.toLowerCase();
                let email = row.cells[4].textContent.toLowerCase();

                if (nama.includes(filter) || alamat.includes(filter) || telepon.includes(filter) || email.includes(filter)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    </script>
@endsection
