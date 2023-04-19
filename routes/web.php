<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route Buku
Route::get('/buku',[App\Http\Controllers\bukuController::class, 'index'])->name('buku');
Route::get('/buku/create',[App\Http\Controllers\bukuController::class, 'create'])->name('buku.create');
Route::post('/buku/store',[App\Http\Controllers\bukuController::class, 'store'])->name('buku.store');
Route::get('/buku/edit/{id}',[App\Http\Controllers\bukuController::class, 'edit'])->name('buku.edit');
Route::put('/buku/update/{id}',[App\Http\Controllers\bukuController::class, 'update'])->name('buku.update');
Route::delete('/buku/delete/{id}',[App\Http\Controllers\bukuController::class, 'destroy'])->name('buku.delete');

// Route Anggota
Route::get('/anggota',[App\Http\Controllers\anggotaController::class, 'index'])->name('anggota');
Route::get('/anggota/create',[App\Http\Controllers\anggotaController::class, 'create'])->name('anggota.create');
Route::post('/anggota/store',[App\Http\Controllers\anggotaController::class, 'store'])->name('anggota.store');
Route::get('/anggota/edit/{id}',[App\Http\Controllers\anggotaController::class, 'edit'])->name('anggota.edit');
Route::put('/anggota/update/{id}',[App\Http\Controllers\anggotaController::class, 'update'])->name('anggota.update');
Route::delete('/anggota/delete/{id}',[App\Http\Controllers\anggotaController::class, 'destroy'])->name('anggota.delete');

// Route Peminjaman
Route::get('/peminjaman',[App\Http\Controllers\peminjamanController::class, 'index'])->name('peminjaman');
Route::get('/peminjaman/create',[App\Http\Controllers\peminjamanController::class, 'create'])->name('peminjaman.create');
Route::post('/peminjaman/store',[App\Http\Controllers\peminjamanController::class, 'store'])->name('peminjaman.store');

// Route Pengembalian
Route::get('/pengembalian',[App\Http\Controllers\pengembalianController::class, 'index'])->name('pengembalian');
Route::get('/pengembalian/edit/{id}',[App\Http\Controllers\pengembalianController::class, 'edit'])->name('pengembalian.edit');
Route::put('/pengembalian/update/{id}',[App\Http\Controllers\pengembalianController::class, 'update'])->name('pengembalian.update');