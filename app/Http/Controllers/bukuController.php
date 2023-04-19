<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
// use Illuminate\Support\Str;
class bukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $keyword = $request->keyword;
        if(strlen($keyword))
        {
            
            $data = buku::where('judul','like',"%$keyword%")
                ->orWhere('penerbit','like',"%$keyword%")
                ->orWhere('stock','like',"%$keyword%")
                ->orWhere('tanggal_terbit','like',"%$keyword%")
                ->paginate(10);
        }
        else{
            $data = buku::orderBy('created_at','desc')->paginate(10);
        }
        return view('buku.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'judul' => 'required',
            'penerbit' => 'required',
            'stock' => 'required',
            'tanggal_terbit' => 'required',
        ]);
        $data = [
            'judul' => $request->judul,
            'penerbit' => $request->penerbit,
            'stock' => $request->stock,
            'tanggal_terbit' => $request->tanggal_terbit
        ];
        buku::create($data);
        return redirect()->to('/buku')->with('success','Data Berhasil di Tambahkan');
        
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = buku::where('id',$id)->first();
        return view('buku.edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'judul' => 'required',
            'penerbit' => 'required',
            'stock' => 'required',
            'tanggal_terbit' => 'required',
        ]);
        $data = [
            'judul' => $request->judul,
            'penerbit' => $request->penerbit,
            'stock' => $request->stock,
            'tanggal_terbit' => $request->tanggal_terbit
        ];
        buku::where('id',$id)->update($data);
        return redirect()->to('/buku')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        buku::where('id',$id)->delete();
        return redirect()->to('/buku')->with('success','Data Berhasil di Hapus');
    }
}
