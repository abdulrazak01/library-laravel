<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
class anggotaController extends Controller
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
            
            $data = anggota::where('nomor_anggota','like',"%$keyword%")
                ->orWhere('nama','like',"%$keyword%")
                ->orWhere('jenis_kelamin','like',"%$keyword%")
                ->orWhere('tanggal_lahir','like',"%$keyword%")
                ->paginate(10);
            // dd($data);
        }
        else{
            $data = anggota::orderBy('created_at','desc')->paginate(10);
        }
        return view('anggota.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('anggota.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_anggota' => 'required|unique:anggota,nomor_anggota',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
        ],[
            'nomor_anggota.unique' => 'Nomor Anggota Sudah Terdaftar',
        ]);
        $data = [
            'nomor_anggota' => $request->nomor_anggota,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir
        ];
        anggota::create($data);
        return redirect()->to('/anggota')->with('success','Data Berhasil di Tambahkan');
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
        $data = anggota::where('id',$id)->first();
        return view('anggota.edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
        ]);
        $data = [
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir
        ];
        anggota::where('id',$id)->update($data);
        return redirect()->to('/anggota')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        anggota::where('id',$id)->delete();
        return redirect()->to('/anggota')->with('success','Data Berhasil di Hapus');
    }
}
