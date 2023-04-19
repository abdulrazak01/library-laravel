<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pengembalian;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;

class pengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if(strlen($keyword))
        {
                $data = DB::table('transaction_peminjaman as a')
                ->leftjoin('anggota as b','b.nomor_anggota','=','a.id_anggota')
                ->leftjoin('buku as c','c.id','=','a.id_buku')
                ->leftjoin('transaction_pengembalian as d','d.id_peminjaman','=','a.id')
                ->select('a.*','a.id as id_peminjaman','b.nomor_anggota','b.nama','c.judul','d.jumlah_denda','d.tanggal_actual_pengembalian')
                ->where('a.id_anggota','like',"%$keyword%")
                ->orWhere('b.nama','like',"%$keyword%")
                ->orWhere('c.judul','like',"%$keyword%")
                ->orWhere('a.tanggal_pinjam','like',"%$keyword%")
                ->orWhere('a.tanggal_pengembalian','like',"%$keyword%")
                ->orWhere('d.tanggal_actual_pengembalian','like',"%$keyword%")
                ->paginate(5);
        }
        else{
            $data = DB::table('transaction_peminjaman as a')
                ->leftjoin('anggota as b','b.nomor_anggota','=','a.id_anggota')
                ->leftjoin('buku as c','c.id','=','a.id_buku')
                ->leftjoin('transaction_pengembalian as d','d.id_peminjaman','=','a.id')
                ->select('a.*','a.id as id_peminjaman','b.nomor_anggota','b.nama','c.judul','d.jumlah_denda','d.tanggal_actual_pengembalian')
                ->paginate(5);
        }
        return view('pengembalian.index')->with('data',$data);
    }

    public function edit(string $id)
    {
        $data_buku = buku::get();
        $data_anggota = anggota::get();
        $data = peminjaman::where('id',$id)->first();
        $DateNow   = date("Y-m-d");
        $date1     = strtotime($DateNow);
        $date2     = strtotime($data->tanggal_pengembalian);
        $range     = $date1 - $date2;
        $days      = $range / 60 /60 / 24;
        $denda = 0;
        if($days > 0)
        {
            $denda = $days * 5000;
        }
        return view('pengembalian.edit')
        ->with('data_anggota',$data_anggota)
        ->with('data_buku',$data_buku)
        ->with('data',$data)
        ->with('denda',$denda);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal_actual_pengembalian' => 'required',
            'jumlah_denda' => 'required',
        ]);
        $data = [
            'id_peminjaman' => $id,
            'jumlah_denda' => $request->jumlah_denda,
            'tanggal_actual_pengembalian' => $request->tanggal_actual_pengembalian,
        ];
        $get_detail_peminjaman = peminjaman::where('id',$id)->select('id_anggota','id_buku','jumlah_buku','tanggal_pinjam','tanggal_pengembalian')->first();
        $get_detail_buku = buku::where('id',$get_detail_peminjaman->id_buku)->select('stock')->first();
        $new_stock = $get_detail_buku->stock + $get_detail_peminjaman->jumlah_buku;
        $data_buku = [
            'stock' => $new_stock,
        ];
        $data_peminjaman = [
            'status' => 1,
        ];
        buku::where('id',$get_detail_peminjaman->id_buku)->update($data_buku);
        peminjaman::where('id',$id)->update($data_peminjaman);
        pengembalian::create($data);

        return redirect()->to('/pengembalian')->with('success','Pengembalian Berhasil');
    }


}
