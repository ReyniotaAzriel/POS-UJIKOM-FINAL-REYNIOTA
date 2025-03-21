<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboard.dashboard-admin');
    }

    public function pelanggan()
    {
        dd(Auth::user());
    }


    public function kasir()
    {
        $data['kategoris'] = Kategori::all();
        return view('dashboard.dashboard-kasir')->with($data);
    }

    public function pemilik()
    {
        // Total Pemasukan dari Penjualan
        $totalPemasukan = Penjualan::sum('total_bayar');

        // Total Pengeluaran dari Pembelian
        $totalPengeluaran = Pembelian::sum('total');

        // Data Grafik Penjualan dan Pembelian per Bulan
        $penjualanPerBulan = Penjualan::selectRaw('MONTH(tgl_faktur) as bulan, SUM(total_bayar) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $pembelianPerBulan = Pembelian::selectRaw('MONTH(tanggal_masuk) as bulan, SUM(total) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        return view('dashboard.dashboard-pemilik', compact('totalPemasukan', 'totalPengeluaran', 'penjualanPerBulan', 'pembelianPerBulan'));
    }
}
