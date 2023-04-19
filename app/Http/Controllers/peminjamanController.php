<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Anggota;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
class peminjamanController extends Controller
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
                ->select('a.*','b.nomor_anggota','b.nama','c.judul')
                ->where('a.id_anggota','like',"%$keyword%")
                ->where('status',0)
                ->orWhere('a.jumlah_buku','like',"%$keyword%")
                ->orWhere('a.tanggal_pinjam','like',"%$keyword%")
                ->orWhere('a.tanggal_pengembalian','like',"%$keyword%")
                ->orWhere('b.nama','like',"%$keyword%")
                ->paginate(5);
            // dd($data);
        }
        else{
            $data = DB::table('transaction_peminjaman as a')
                ->leftjoin('anggota as b','b.nomor_anggota','=','a.id_anggota')
                ->leftjoin('buku as c','c.id','=','a.id_buku')
                ->select('a.*','b.nomor_anggota','b.nama','c.judul')
                ->where('status',0)
                ->paginate(5);
        }

        return view('peminjaman.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data_buku = buku::where('stock','>',0)->get();
        $data_anggota = anggota::get();
        return view('peminjaman.create')
        ->with('data_anggota',$data_anggota)
        ->with('data_buku',$data_buku);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_anggota' => 'required',
            'id_buku' => 'required',
            'jumlah_buku' => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_pengembalian' => 'required',
        ]);
        $data = [
            'id_anggota' => $request->id_anggota,
            'id_buku' => $request->id_buku,
            'jumlah_buku' => $request->jumlah_buku,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'status' => 0,
        ];
        $stock_old = buku::where('id',$request->id_buku)->select('stock')->get();
        $count_stock = $stock_old[0]->stock - $request->jumlah_buku;
        if($count_stock >= 0)
        {
            $data_stock_buku =[
                'stock' => $count_stock
            ];
            peminjaman::create($data);
            buku::where('id',$request->id_buku)->update($data_stock_buku);
            return redirect()->to('/peminjaman')->with('success','Data Berhasil di Tambahkan');
        }
        else{
            return redirect()->to('/peminjaman/create')->with('error','Jumlah Buku Yang Di Pinjam Melebihi Stock');
        }
        
    }

}
