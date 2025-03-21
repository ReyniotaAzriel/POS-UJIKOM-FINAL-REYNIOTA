<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanBarang;

class DaftarPengajuanController extends Controller
{
    public function index()
    {
        $pengajuan = PengajuanBarang::with('pelanggan', 'barang')->get();
        $pelanggan = \App\Models\Pelanggan::all(); // Tambahkan ini
        $barang = \App\Models\Barang::all(); // Tambahkan ini

        return view('admin.daftar_pengajuan.daftar', compact('pengajuan', 'pelanggan', 'barang'));
    }


    public function updateStatus(Request $request, $id)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'status' => ['required', Rule::in(['pending', 'diterima', 'ditolak'])],
            ]);

            // Cari data
            $pengajuan = PengajuanBarang::findOrFail($id);

            // Update status
            $pengajuan->status = $validated['status'];
            $pengajuan->save();

            return response()->json(['success' => true, 'status' => $pengajuan->status]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'message' => 'Status tidak valid!'], 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'barang_id' => 'nullable|exists:barang,id',
            'nama_barang' => 'required_without:barang_id|string|max:255',
            'deskripsi' => 'required_without:barang_id|string',
            'qty' => 'required|integer|min:1',
            'tanggal_pengajuan' => 'required|date',
        ]);

        $pengajuan = PengajuanBarang::findOrFail($id);
        $pengajuan->update([
            'pelanggan_id' => $request->pelanggan_id,
            'barang_id' => $request->barang_id ?? null,
            'nama_barang' => $request->barang_id ? null : $request->nama_barang,
            'deskripsi' => $request->barang_id ? null : $request->deskripsi,
            'qty' => $request->qty,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
        ]);

        return redirect()->route('daftar-pengajuan.index')->with('success', 'Pengajuan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pengajuan = PengajuanBarang::findOrFail($id);
        $pengajuan->delete();

        return redirect()->route('daftar-pengajuan.index')->with('success', 'Pengajuan berhasil dihapus');
    }
}
