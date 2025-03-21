<?php

namespace App\Exports;

use App\Models\PengajuanBarang;
use Maatwebsite\Excel\Concerns\FromCollection;

class PengajuanExport implements FromCollection
{
    public function collection()
    {
        return PengajuanBarang::all(); // Mengambil semua data dari tabel pengajuan_barang
    }
}
