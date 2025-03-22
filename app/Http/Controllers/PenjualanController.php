<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Barang;
use App\Models\Pelanggan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::with(['detailPenjualan.barang', 'pelanggan'])
            ->latest()
            ->paginate(5);

        return view('kasir.penjualan.index', compact('penjualans'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        $barangs = Barang::where('stok', '>', 1)->get();

        return view('kasir.penjualan.create', compact('pelanggans', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'keranjang_data' => 'required|json',
            'pelanggan_id' => 'nullable|exists:pelanggan,id',
        ]);

        $keranjang = json_decode($request->keranjang_data, true);
        if (!$keranjang || empty($keranjang)) {
            return back()->with('error', 'Keranjang tidak boleh kosong.');
        }

        DB::beginTransaction();
        try {
            // Membuat nomor faktur yang unik
            $lastId = Penjualan::max('id') + 1;
            $noFaktur = 'P-' . now()->format('Ymd') . '-' . str_pad($lastId, 4, '0', STR_PAD_LEFT);

            // Menyimpan data penjualan
            $penjualan = Penjualan::create([
                'no_faktur' => $noFaktur,
                'tgl_faktur' => now(),
                'total_bayar' => 0,
                'pelanggan_id' => $request->pelanggan_id,
                'user_id' => Auth::id(),
                'status_pembayaran' => 'pending',
            ]);

            // Ambil semua barang dalam keranjang sekaligus untuk menghindari query dalam loop
            $barangIds = array_keys($keranjang);
            $barangs = Barang::whereIn('id', $barangIds)->get()->keyBy('id');

            $totalHarga = 0;
            foreach ($keranjang as $barangId => $item) {
                if (!isset($barangs[$barangId])) {
                    throw new \Exception("Barang dengan ID $barangId tidak ditemukan.");
                }

                $barang = $barangs[$barangId];
                $jumlah = $item['jumlah'];

                if ($jumlah > $barang->stok) {
                    throw new \Exception("Stok barang {$barang->nama_barang} tidak mencukupi.");
                }

                $subTotal = $barang->harga_jual * $jumlah;

                DetailPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'barang_id' => $barangId,
                    'harga_jual' => $barang->harga_jual,
                    'jumlah' => $jumlah,
                    'sub_total' => $subTotal,
                ]);

                // Kurangi stok barang
                $barang->decrement('stok', $jumlah);
                $totalHarga += $subTotal;
            }

            // Update total bayar
            $penjualan->update(['total_bayar' => $totalHarga]);

            DB::commit();

            return redirect()->route('penjualan.show', $penjualan->id)
                ->with('success', 'Transaksi berhasil!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Gagal menyimpan penjualan', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $penjualan = Penjualan::with('detailPenjualan.barang')->findOrFail($id);
        return view('kasir.penjualan.show', compact('penjualan'));
    }

    public function getChartData()
    {
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();

        // Ambil data dari database
        $data = Penjualan::select(
            DB::raw('DATE(tgl_faktur) as tanggal'),
            DB::raw('COUNT(*) as jumlah_transaksi'),
            DB::raw('SUM(total_bayar) as total_pendapatan')
        )
            ->whereBetween('tgl_faktur', [$startDate, $endDate])
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'ASC')
            ->get();

        // Debugging: Cek apakah query berhasil mengambil data

        return response()->json($data);
    }

    public function jumlahTransaksi()
    {
        $jumlahTransaksi = Penjualan::count();

        return response()->json([
            'success' => true,
            'message' => 'Jumlah transaksi penjualan',
            'data' => $jumlahTransaksi
        ]);
    }
}
