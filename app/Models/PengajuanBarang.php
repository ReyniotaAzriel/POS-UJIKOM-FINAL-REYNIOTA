<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanBarang extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_barang';

    protected $fillable = [
        'pelanggan_id',
        'barang_id',
        'nama_barang',
        'deskripsi',
        'qty',
        'status',
        'tanggal_pengajuan'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
