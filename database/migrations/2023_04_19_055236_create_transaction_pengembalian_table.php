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
        Schema::create('transaction_pengembalian', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_peminjaman');
            $table->integer('jumlah_denda');
            $table->date('tanggal_actual_pengembalian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_pengembalian');
    }
};
