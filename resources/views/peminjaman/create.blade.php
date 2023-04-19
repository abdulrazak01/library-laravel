@extends('layouts.app')
@section('content')

@if($errors->any())

<div class="pt-3">
    <div class="alert alert-danger">
        @foreach ($errors->all() as $item)
            <li>{{$item}}</li>
        @endforeach
    </div>
</div>
@endif
       <!-- START FORM -->
       <body class="bg-light">
        <main class="container">
       <form action='{{ url('peminjaman/store') }}' method='post'>
        @csrf
        <div class="card">
            <h5 class="card-header">Peminjaman</h5>
            <div class="card-body">
                <div class="my-3 p-3 bg-body rounded shadow-sm">
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">Nomor Anggota</label>
                        <div class="col-sm-10">
                            <select class="form-control" data-plugin="select2" id="id_anggota" name="id_anggota" data-placeholder="Select Jenis Kelamin">
                                <option value="">Pilih Nomor Anggota</option>
                                @foreach ($data_anggota as $item)
                                    <option value="{{$item->nomor_anggota}}">{{$item->nomor_anggota}} - {{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Judul Buku</label>
                        <div class="col-sm-10">
                            <select class="form-control" required="required" data-plugin="select2" id="id_buku" name="id_buku" data-placeholder="Select Jenis Kelamin">
                                <option value="">Pilih Judul Buku</option>
                                @foreach ($data_buku as $item)
                                    <option value="{{$item->id}}">{{$item->judul}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Jumlah Buku Yang Dipinjam</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name='jumlah_buku' id="jumlah_buku">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Tanggal Peminjaman</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name='tanggal_pinjam' id="tanggal_pinjam">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Tanggal Pengembalian</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name='tanggal_pengembalian' id="tanggal_pengembalian">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
                    </div>
                  </form>
                </div>
            </div>
          </div>
        
    </body>
    </html>
        <!-- AKHIR FORM -->
@endsection