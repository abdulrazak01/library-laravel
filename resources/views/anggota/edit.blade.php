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
       <form action='{{ url('anggota/update/'.$data->id) }}' method='post'>
        @csrf
        @method('PUT')
        <div class="card">
            <h5 class="card-header">Edit Data Anggota</h5>
            <div class="card-body">
                <div class="my-3 p-3 bg-body rounded shadow-sm">
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">Nomor Anggota</label>
                        <div class="col-sm-10">
                            {{$data->nomor_anggota}}
                            {{-- <input type="text" class="form-control" name='nomor_anggota' value="" id="nomor_anggota"> --}}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Anggota</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='nama' value="{{$data->nama}}" id="nama">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select class="form-control" required="required" data-plugin="select2" id="jenis_kelamin" name="jenis_kelamin" data-placeholder="Select Jenis Kelamin">
                                <option>Pilih Jenis Kelamin</option>
                                <option value="Pria" @if($data->jenis_kelamin == 'Pria')
                                    {{'selected'}}
                                @endif>Pria</option>
                                <option value="Wanita" @if($data->jenis_kelamin == 'Wanita')
                                    {{'selected'}}
                                @endif>Wanita</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name='tanggal_lahir' value="{{$data->tanggal_lahir}}" id="tanggal_lahir">
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