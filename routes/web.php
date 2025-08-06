<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin.index');

});




Route::resource('kategori', KategoriController::class);
Route::resource('barang', BarangController::class);
Route::resource('barang-masuk', BarangMasukController::class);
Route::resource('barang-keluar', BarangKeluarController::class);
Route::get('/cetak', [BarangController::class, 'cetak'])->name('barang.cetak');
Route::get('/barang-masuk/cetak', [BarangMasukController::class, 'cetak'])->name('barang-masuk.cetak');
Route::get('/barang-keluar/cetak', [BarangKeluarController::class, 'cetak'])->name('barang-keluar.cetak');



