<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $fillable = ['nomor_anggota','nama','jenis_kelamin','tanggal_lahir'];
    protected $table = 'anggota';
}
