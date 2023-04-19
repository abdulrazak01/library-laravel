@extends('layouts.app')
@section('content')
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body class="bg-light">
    <main class="container">
      <div class="card">
        <h5 class="card-header">List Data Peminjaman</h5>
        <div class="card-body">
          <div class="my-3 p-3 bg-body rounded shadow-sm">
            <!-- FORM PENCARIAN -->
            <div class="pb-3">
              <form class="d-flex" action="{{url('peminjaman')}}" method="get">
                  <input class="form-control me-1" type="search" name="keyword" value="{{ Request::get('keyword') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                  <button class="btn btn-secondary" type="submit">Cari</button>
              </form>
            </div>
            
            <!-- TOMBOL TAMBAH DATA -->
            <div class="pb-3">
              <a href="{{ url('/peminjaman/create') }}" class="btn btn-primary">+ Tambah Data</a>
            </div>
      
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-3">Nomor Anggota</th>
                        <th class="col-md-3">Nama Anggota</th>
                        <th class="col-md-2">Judul Buku</th>
                        <th class="col-md-2">Jumlah Buku Yang DiPinjam</th>
                        <th class="col-md-2">Tanggal Peminjaman</th>
                        <th class="col-md-2">Tanggal Pengembalian</th>
                        <th class="col-md-2">Lama Peminjaman</th>
                        {{-- <th class="col-md-4">Aksi</th> --}}
                    </tr>
                </thead>
                <tbody>
                    <?php $i = $data->firstItem() ?>
                    @foreach($data as $item)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$item->nomor_anggota}}</td>
                        <td>{{$item->nama}}</td>
                        <td>{{$item->judul}}</td>
                        <td>{{$item->jumlah_buku}}</td>
                        <td>{{$item->tanggal_pinjam}}</td>
                        <td>{{$item->tanggal_pengembalian}}</td>
                        <td>
                          <?php
                          {{
                           
                            $date1     = strtotime($item->tanggal_pinjam);
                            $date2     = strtotime($item->tanggal_pengembalian);
                            $range     = $date2 - $date1;
                            $days      = $range / 60 / 60 / 24;
                            echo '<p style="color:black;">'.$days.' Hari</p>';
                          }}
                          ?>
                        </td>
                        {{-- <td>
                            <a href='{{url('peminjaman/edit/'.$item->id)}}' class="btn btn-warning btn-sm">Edit</a>
                            <form onsubmit="return confirm('Apakah Anda Yakin Ingin Mengahpus Data ini?')"class="d-inline" action="{{url('anggota/delete/'.$item->id)}}" method="post">
                             @csrf
                             @method('DELETE')
                                <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                            </form> 
                        </td> --}}
                    </tr>
                    <?php $i++ ?>
                    @endforeach
                    
                </tbody>
            </table>
           {{$data->withQueryString()->links()}}
      </div>
        </div>
      </div>
      
    </main>
    
  </body>
</html>
@endsection