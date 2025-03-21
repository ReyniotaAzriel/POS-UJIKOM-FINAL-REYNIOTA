@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Daftar Pengajuan Barang</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <a href="{{ url('/export-excel') }}" class="btn btn-success">Export ke Excel</a>
        <a href="{{ url('/export-pdf') }}" class="btn btn-danger">Export ke PDF</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Pelanggan</th>
                    <th>Nama Barang</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Qty</th>
                    <th>Terpenuhi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengajuan as $p)
                    <tr>
                        <td>{{ $p->pelanggan->nama }}</td>
                        <td>{{ $p->barang ? $p->barang->nama_barang : $p->nama_barang }}</td>
                        <td>{{ $p->tanggal_pengajuan }}</td>
                        <td>{{ $p->qty }}</td>
                        <td>
                            <select class="form-select status-select" data-id="{{ $p->id }}">
                                <option value="diterima" {{ $p->status === 'diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="ditolak" {{ $p->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </td>

                        <td>
                            <button class="btn btn-primary btn-sm edit-btn" data-id="{{ $p->id }}"
                                data-pelanggan="{{ $p->pelanggan_id }}" data-barang="{{ $p->barang_id }}"
                                data-nama_barang="{{ $p->nama_barang }}" data-deskripsi="{{ $p->deskripsi }}"
                                data-qty="{{ $p->qty }}" data-tanggal="{{ $p->tanggal_pengajuan }}"
                                data-status="{{ $p->status }}">
                                Edit
                            </button>

                            <form action="{{ route('daftar-pengajuan.destroy', $p->id) }}" method="POST"
                                style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Pengajuan Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST">
                    @csrf

                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">

                        <div class="mb-3">
                            <label for="edit-pelanggan" class="form-label">Pelanggan</label>
                            <select name="pelanggan_id" id="edit-pelanggan" class="form-control" required>
                                @foreach ($pelanggan as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="edit-barang" class="form-label">Barang</label>
                            <select name="barang_id" id="edit-barang" class="form-control">
                                <option value="">Barang Baru</option>
                                @foreach ($barang as $b)
                                    <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="edit-nama_barang" class="form-label">Nama Barang (Jika Baru)</label>
                            <input type="text" name="nama_barang" id="edit-nama_barang" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="edit-deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="edit-deskripsi" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="edit-qty" class="form-label">Qty</label>
                            <input type="number" name="qty" id="edit-qty" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-tanggal" class="form-label">Tanggal Pengajuan</label>
                            <input type="date" name="tanggal_pengajuan" id="edit-tanggal" class="form-control" required>
                        </div>

                        <!-- Status hanya untuk tampilan (tidak bisa diubah) -->
                        <div class="mb-3">
                            <label for="edit-status-display" class="form-label">Status</label>
                            <select id="edit-status-display" class="form-control" disabled>
                                <option value="diterima">Diterima</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                            <input type="hidden" name="status" id="edit-status">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Edit button
        document.querySelectorAll('.edit-btn').forEach((button) => {
            button.addEventListener('click', function() {
                document.getElementById('editForm').setAttribute('action', `/daftar-pengajuan/${this.dataset.id}`);

                Object.keys(this.dataset).forEach(key => {
                    let input = document.getElementById(`edit-${key}`);
                    if (input) input.value = this.dataset[key];
                });

                // Isi status ke input hidden dan dropdown yang tidak bisa diedit
                document.getElementById('edit-status').value = this.dataset.status;
                document.getElementById('edit-status-display').value = this.dataset.status;

                new bootstrap.Modal(document.getElementById('editModal')).show();
            });
        });

        // Update status langsung dari tabel
        document.querySelectorAll('.status-select').forEach((el) => {
            el.addEventListener('change', function() {
                let id = this.dataset.id;
                let status = this.value;

                fetch(`/toggle-status/${id}`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            status: status
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Status berhasil diperbarui menjadi: " + data.status);
                        } else {
                            alert("Gagal memperbarui status.");
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("Terjadi kesalahan, silakan coba lagi.");
                    });
            });
        });
    </script>
@endsection
