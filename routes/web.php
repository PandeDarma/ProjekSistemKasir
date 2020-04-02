<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// barang
Route::get('/barang', 'BarangController@index');
Route::get('/barang/tambah', 'BarangController@tambah');
Route::patch('/barang', 'BarangController@addBarang');
Route::delete('/barang/{barang}', 'BarangController@delete');
Route::get('/barang/{barang}/edit', 'BarangController@edit');
Route::put('/barang/{barang}', "BarangController@editBarang");
Route::get('/barang/kategori', "BarangController@tambahkategori");
Route::post('/barang/kategori', "BarangController@addKategori");
// kasir
Route::get("/stock", 'TransaksiController@stock');
