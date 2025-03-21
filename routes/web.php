<?php

use App\Http\Controllers\PDFController;
use App\Exports\PengajuanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LaporanBarangController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PengajuanBarangController;
use App\Http\Controllers\DaftarPengajuanController;

Route::get('/', function () {
    return view('auth.login');
});

// Login & Register Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Middleware Authentication
Route::middleware(['auth'])->group(function () {

    // Dashboard Redirection based on Role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'kasir' => redirect()->route('kasir.dashboard'),
            'pemilik' => redirect()->route('pemilik.dashboard'),
            'pelanggan' => redirect()->route('pelanggan.dashboard'),
            default => abort(403, 'Unauthorized'),
        };
    })->name('dashboard');

    // Logout Route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin Routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

        // Kategori Routes
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::patch('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

        // Barang Routes
        Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
        Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
        Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
        Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
        Route::patch('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
        Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

        // Pemasok Routes
        Route::get('/pemasok', [PemasokController::class, 'index'])->name('pemasok.index');
        Route::post('/pemasok', [PemasokController::class, 'store'])->name('pemasok.store');
        Route::get('/pemasok/create', [PemasokController::class, 'create'])->name('pemasok.create');
        Route::patch('/pemasok/{id}', [PemasokController::class, 'update'])->name('pemasok.update');
        Route::delete('/pemasok/{id}', [PemasokController::class, 'destroy'])->name('pemasok.destroy');
        Route::get('/pemasok/{id}', [PemasokController::class, 'show'])->name('pemasok.show');

        // Pembelian Routes
        Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
        Route::get('/pembelian/create', [PembelianController::class, 'create'])->name('pembelian.create');
        Route::post('/pembelian', [PembelianController::class, 'store'])->name('pembelian.store');
        Route::get('/pembelian/{id}', [PembelianController::class, 'show'])->name('pembelian.show');

        // Pelanggan Routes
        Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
        Route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
        Route::post('/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
        Route::get('/pelanggan/{id}', [PelangganController::class, 'show'])->name('pelanggan.show');
        Route::get('/pelanggan/{id}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
        Route::put('/pelanggan/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
        Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

        //Pengajuan
        Route::get('/pengajuan', [PengajuanBarangController::class, 'index'])->name('pengajuan.index');
        Route::get('/pengajuan/create', [PengajuanBarangController::class, 'create'])->name('pengajuan.create');
        Route::post('/pengajuan', [PengajuanBarangController::class, 'store'])->name('pengajuan.store');
        // daftar pengajuan
        Route::get('/daftar-pengajuan', [DaftarPengajuanController::class, 'index'])->name('daftar-pengajuan.index');
        Route::post('/daftar-pengajuan/update-status/{id}', [DaftarPengajuanController::class, 'updateStatus'])->name('daftar-pengajuan.update-status');
        Route::post('/daftar-pengajuan/{id}', [DaftarPengajuanController::class, 'update'])->name('daftar-pengajuan.update');
        Route::delete('/daftar-pengajuan/{id}', [DaftarPengajuanController::class, 'destroy'])->name('daftar-pengajuan.destroy');

        Route::post('/toggle-status/{id}', [PengajuanBarangController::class, 'toggleStatus']);
        // Route::put('/daftar-pengajuan/update-status/{id}', [PengajuanController::class, 'updateStatus']);

        //chart
        Route::get('/admin/penjualan/chart', [PenjualanController::class, 'getChartData']);


        //export
        Route::get('/export-excel', function () {
            return Excel::download(new PengajuanExport, 'pengajuan.xlsx');
        });

        Route::get('/export-pdf', [PDFController::class, 'exportPDF']);

    });

    // Kasir Routes
    Route::middleware(['role:kasir'])->group(function () {
        Route::get('/kasir/dashboard', [DashboardController::class, 'kasir'])->name('kasir.dashboard');

        Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
        Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');
        Route::post('/penjualan', [PenjualanController::class, 'store'])->name('penjualan.store');
        Route::get('/penjualan/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');
    });

    // Pemilik Routes
    Route::middleware(['role:pemilik'])->group(function () {
        Route::get('/pemilik/dashboard', [DashboardController::class, 'pemilik'])->name('pemilik.dashboard');

        Route::get('laporan/kategori', [LaporanController::class, 'kategori'])->name('laporan.kategori');
        Route::get('laporan/barang', [LaporanController::class, 'barang'])->name('laporan.barang');
        Route::get('laporan/pemasok', [LaporanController::class, 'pemasok'])->name('laporan.pemasok');
        Route::get('laporan/pelanggan', [LaporanController::class, 'pelanggan'])->name('laporan.pelanggan');
        Route::get('laporan/penjualan', [LaporanController::class, 'penjualan'])->name('laporan.penjualan');
        Route::get('laporan/penjualan/{id}', [LaporanController::class, 'showPenjualan'])->name('laporan.show.penjualan');
        Route::get('laporan/pembelian', [LaporanController::class, 'pembelian'])->name('laporan.pembelian');
        Route::get('laporan/pembelian/{id}', [LaporanController::class, 'showPembelian'])->name('laporan.show.pembelian');
    });

    // Route::middleware(['role:pelanggan'])->group(function () {
    //     Route::get('/pelanggan/dashboard', [DashboardController::class, 'pelanggan'])->name('pelanggan.dashboard');

    //     Route::get('/pengajuan', [PengajuanBarangController::class, 'index'])->name('pengajuan.index');
    //     Route::get('/pengajuan/create', [PengajuanBarangController::class, 'create'])->name('pengajuan.create');
    //     Route::post('/pengajuan', [PengajuanBarangController::class, 'store'])->name('pengajuan.store');


    // });




});

Route::get('/unauthorized', function () {
    return view('errors.unauthorized');
});
