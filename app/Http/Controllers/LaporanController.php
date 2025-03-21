<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Pelanggan;
use App\Models\Pemasok;
use App\Models\Pembelian;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function kategori(Request $request)
    {
        $query = Kategori::query();

        // Filter berdasarkan nama kategori
        if ($request->has('nama_kategori') && $request->nama_kategori != '') {
            $query->where('nama_kategori', 'like', '%' . $request->nama_kategori . '%');
        }

        $kategoris = $query->get();

        return view('pemilik.laporan.kategori', compact('kategoris'));
    }

    public function barang(Request $request)
    {
        $query = Barang::query();

        // Filter berdasarkan nama barang
        if ($request->has('nama_barang') && $request->nama_barang != '') {
            $query->where('nama_barang', 'like', '%' . $request->nama_barang . '%');
        }


        // Filter berdasarkan kategori
        if ($request->has('kategori_id') && $request->kategori_id != '') {
            $query->where('kategori_id', $request->kategori_id);
        }

        $barangs = $query->with('kategori')->get();
        $kategoris = Kategori::all();

        return view('pemilik.laporan.barang', compact('barangs', 'kategoris'));
    }

    public function pemasok(Request $request)
    {
        $query = Pemasok::query();

        // Filter berdasarkan nama pemasok
        if ($request->has('nama') && $request->nama != '') {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        $pemasoks = $query->get();

        return view('pemilik.laporan.pemasok', compact('pemasoks'));
    }

    public function pelanggan(Request $request)
    {
        $query = Pelanggan::query();

        // Filter berdasarkan nama pelanggan
        if ($request->has('nama') && $request->nama != '') {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        $pelanggans = $query->get();

        return view('pemilik.laporan.pelanggan', compact('pelanggans'));
    }

    public function penjualan(Request $request)
    {
        $query = Penjualan::with('pelanggan', 'user');

        // Filter berdasarkan tanggal
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('tgl_faktur', $request->tanggal);
        }

        // Filter berdasarkan pelanggan
        if ($request->has('pelanggan') && $request->pelanggan != '') {
            $query->whereHas('pelanggan', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->pelanggan . '%');
            });
        }

        $penjualans = $query->get();

        return view('pemilik.laporan.penjualan', compact('penjualans'));
    }

    public function showPenjualan($id)
    {
        $penjualan = Penjualan::with(['pelanggan', 'user', 'detailPenjualan.barang'])->findOrFail($id);

        return view('pemilik.laporan.detailPenjualan', compact('penjualan'));
    }

    public function pembelian(Request $request)
    {
        $query = Pembelian::with('pemasok', 'user');

        // Filter berdasarkan tanggal
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('tanggal_masuk', $request->tanggal);
        }

        // Filter berdasarkan pemasok
        if ($request->has('pemasok') && $request->pemasok != '') {
            $query->whereHas('pemasok', function ($q) use ($request) {
                $q->where('nama_pemasok', 'like', '%' . $request->pemasok . '%');
            });
        }

        $pembelians = $query->get();

        return view('pemilik.laporan.pembelian', compact('pembelians'));
    }

    public function showPembelian($id)
    {
        $pembelian = Pembelian::with(['pemasok', 'user', 'detailPembelian.barang'])->findOrFail($id);

        return view('pemilik.laporan.detailPembelian', compact('pembelian'));
    }
}