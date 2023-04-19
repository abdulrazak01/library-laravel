<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $fillable = ['id_buku','id_anggota','jumlah_buku','tanggal_pinjam','tanggal_pengembalian','status'];
    protected $table = 'transaction_peminjaman';
}
