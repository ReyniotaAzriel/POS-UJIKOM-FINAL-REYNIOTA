<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanBarang;
use App\Models\Pelanggan;
use App\Models\Barang;

class PengajuanBarangController extends Controller
{
    public function index()
    {
        $pengajuan = PengajuanBarang::with('pelanggan', 'barang')->get();
        return view('admin.pengajuan_pelanggan.pengajuan.index', compact('pengajuan'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        $barang = Barang::all();
        return view('admin.pengajuan_pelanggan.pengajuan.create', compact('pelanggan', 'barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'barang_id' => 'nullable|exists:barang,id',
            'nama_barang' => 'required_without:barang_id|string|max:255',
            'deskripsi' => 'required_without:barang_id|string',
            'qty' => 'required|integer|min:1',
            'tanggal_pengajuan' => 'required|date',
        ]);

        PengajuanBarang::create([
            'pelanggan_id' => $request->pelanggan_id,
            'barang_id' => $request->barang_id ?? null,
            'nama_barang' => $request->barang_id ? null : $request->nama_barang,
            'deskripsi' => $request->barang_id ? null : $request->deskripsi,
            'qty' => $request->qty,
            'status' => 'pending',
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
        ]);

        return redirect('/pengajuan')->with('success', 'Pengajuan berhasil dikirim');
    }



    public function daftarPengajuan()
    {
        $pengajuan = PengajuanBarang::with('pelanggan', 'barang')->get();
        return view('admin.daftar_pengajuan.daftar', compact('pengajuan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = $request->status;
        $pengajuan->save();

        return response()->json(['success' => true]);
    }


    public function toggleStatus($id)
    {
        $pengajuan = PengajuanBarang::findOrFail($id);

        // Dapatkan status dari request
        $statusBaru = request()->input('status');

        // Update status
        $pengajuan->status = $statusBaru;
        $pengajuan->save();

        return response()->json(['success' => true, 'status' => $pengajuan->status]);
    }

    public function update(Request $request, $id)
    {
        $pengajuan = PengajuanBarang::findOrFail($id);

        // Validasi input
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'qty' => 'required|integer|min:1',
            'tanggal_pengajuan' => 'required|date',
            'status' => 'required|in:diterima,ditolak'
        ]);

        // Update data
        $pengajuan->pelanggan_id = $request->pelanggan_id;
        $pengajuan->barang_id = $request->barang_id ?: null;
        $pengajuan->nama_barang = $request->barang_id ? null : $request->nama_barang;
        $pengajuan->deskripsi = $request->deskripsi;
        $pengajuan->qty = $request->qty;
        $pengajuan->tanggal_pengajuan = $request->tanggal_pengajuan;
        $pengajuan->status = $request->status;
        $pengajuan->save();

        return redirect()->back()->with('success', 'Pengajuan barang berhasil diperbarui.');
    }
}
