<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\PengajuanBarang;

class PDFController extends Controller
{
    public function exportPDF()
    {
        $pengajuan = PengajuanBarang::all();
        $pdf = PDF::loadView('pdf.pengajuan', compact('pengajuan'));
        return $pdf->download('pengajuan.pdf');
    }
}
