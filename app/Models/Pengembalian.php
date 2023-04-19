<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $fillable = ['id_peminjaman','jumlah_denda','tanggal_actual_pengembalian'];
    protected $table = 'transaction_pengembalian';
}
