<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Pemasok;
use App\Models\User;
use App\Models\DetailPembelian;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelians = Pembelian::with(['pemasok', 'user'])->orderBy('tanggal_masuk', 'desc')->get();
        return view('admin.pembelian.index', compact('pembelians'));
    }

    public function create()
    {
        $pemasoks = Pemasok::all();
        $users = User::all();
        $barangs = Barang::all();
        return view('admin.pembelian.create', compact('pemasoks', 'users', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_masuk' => 'required|date',
            'pemasok_id' => 'required|exists:pemasok,id',
            'barang_id' => 'required|array',
            'harga_beli' => 'required|array',
            'jumlah' => 'required|array',
        ]);

        DB::beginTransaction();
        try {
            $pembelian = Pembelian::create([
                'kode_masuk' => $this->generateKodePembelian(),
                'tanggal_masuk' => $request->tanggal_masuk,
                'pemasok_id' => $request->pemasok_id,
                'user_id' => auth()->id(),
                'total' => 0, // Akan diperbarui setelah perhitungan
            ]);

            $total = 0;

            foreach ($request->barang_id as $key => $barang_id) {
                $harga_beli = $request->harga_beli[$key];
                $jumlah = $request->jumlah[$key];

                // Harga jual otomatis 5% lebih tinggi dari harga beli
                $harga_jual = $harga_beli * 1.05;

                $sub_total = $harga_beli * $jumlah;
                $total += $sub_total;

                DetailPembelian::create([
                    'pembelian_id' => $pembelian->id,
                    'barang_id' => $barang_id,
                    'harga_beli' => $harga_beli,
                    'harga_jual' => $harga_jual,
                    'jumlah' => $jumlah,
                    'sub_total' => $sub_total,
                ]);

                // Update stok barang
                $barang = Barang::find($barang_id);
                $barang->tambahStok($jumlah);

                // **Perbarui harga jual barang di database setiap kali ada pembelian**
                $barang->update(['harga_jual' => $harga_jual]);
            }

            $pembelian->update(['total' => $total]);

            DB::commit();
            return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('pembelian.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function generateKodePembelian()
    {
        $tanggal = date('Ymd');
        $baseKode = "PB-{$tanggal}-";

        return DB::transaction(function () use ($baseKode) {
            $lastPembelian = Pembelian::where('kode_masuk', 'LIKE', "{$baseKode}%")
                ->lockForUpdate()
                ->orderBy('kode_masuk', 'desc')
                ->first();

            $lastNumber = $lastPembelian
                ? (int) substr($lastPembelian->kode_masuk, -3) + 1
                : 1;

            return $baseKode . str_pad($lastNumber, 3, '0', STR_PAD_LEFT);
        });
    }

    public function show($id)
    {
        $pembelian = Pembelian::with(['pemasok', 'user', 'detailPembelian.barang'])->findOrFail($id);
        return view('admin.pembelian.show', compact('pembelian'));
    }
}
