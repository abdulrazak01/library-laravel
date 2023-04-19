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
       <form action='{{ url('pengembalian/update/'.$data->id) }}' method='post'>
        @csrf
        @method('PUT')
        <div class="card">
            <h5 class="card-header">Pengembalian</h5>
            <div class="card-body">
                <div class="my-3 p-3 bg-body rounded shadow-sm">
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">Nomor Anggota</label>
                        <div class="col-sm-10">
                            <select class="form-control"  data-plugin="select2" id="id_anggota" name="id_anggota" data-placeholder="Select Jenis Kelamin">
                                <option>Pilih Nomor Anggota</option>
                                @foreach ($data_anggota as $item)
                                    <option value="{{$item->nomor_anggota}}" @if($data->id_anggota == $item->nomor_anggota)
                                        {{'selected'}}
                                    @endif>{{$item->nomor_anggota}} - {{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Judul Buku</label>
                        <div class="col-sm-10">
                            <select class="form-control" data-plugin="select2" id="id_buku" name="id_buku" data-placeholder="Select Jenis Kelamin">
                                <option>Pilih Judul Buku</option>
                                @foreach ($data_buku as $item)
                                <option value="{{$item->id}}" @if($data->id_buku == $item->id)
                                    {{'selected'}}
                                @endif>{{$item->judul}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Jumlah Buku Yang Dipinjam</label>
                        <div class="col-sm-10">
                            <input type="number" readonly class="form-control" value="{{$data->jumlah_buku}}" name='jumlah_buku' id="jumlah_buku">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Tanggal Peminjaman</label>
                        <div class="col-sm-10">
                            <input type="date" readonly class="form-control" value="{{$data->tanggal_pinjam}}" name='tanggal_pinjam' id="tanggal_pinjam">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Tanggal Pengembalian</label>
                        <div class="col-sm-10">
                            <input type="date" readonly class="form-control" value="{{$data->tanggal_pengembalian}}" name='tanggal_pengembalian' id="tanggal_pengembalian">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Tanggal Actual Pengembalian</label>
                        <div class="col-sm-10">
                            <input type="date" readonly class="form-control" value="<?php echo date('Y-m-d'); ?>" name='tanggal_actual_pengembalian' id="tanggal_actual_pengembalian">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Jumlah Denda</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control" value="{{$denda}}" name='jumlah_denda' id="jumlah_denda">
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

        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script>
            $( document ).ready(function() {
                // console.log( "document loaded" );
            });
        </script>
    </body>
    </html>

        <!-- AKHIR FORM -->
@endsection