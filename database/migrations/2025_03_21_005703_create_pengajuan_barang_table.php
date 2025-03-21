<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pengajuan_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('pelanggan')->onDelete('cascade');
            $table->foreignId('barang_id')->nullable()->constrained('barang')->onDelete('set null');
            $table->string('nama_barang')->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('qty');
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->date('tanggal_pengajuan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengajuan_barang');
    }
};
