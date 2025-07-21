<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;


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
// Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
// Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::resource('barang', BarangController::class);

