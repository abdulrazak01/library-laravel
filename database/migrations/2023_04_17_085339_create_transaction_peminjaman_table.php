<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_peminjaman', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_buku');
            $table->integer('id_anggota');
            $table->integer('jumlah_buku');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_pengembalian');
            $table->enum('status', [0,1]);
            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_peminjaman');
    }
};
