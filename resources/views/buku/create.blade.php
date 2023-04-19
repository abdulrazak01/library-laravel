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
       <form action='{{ url('buku/store') }}' method='post'>
        @csrf
        <div class="card">
            <h5 class="card-header">Add Data Buku</h5>
            <div class="card-body">
                <div class="my-3 p-3 bg-body rounded shadow-sm">
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='judul' id="judul">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Penerbit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='penerbit' id="penerbit">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Stock</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name='stock' id="stock">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Tanggal Terbit</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name='tanggal_terbit' id="tanggal_terbit">
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