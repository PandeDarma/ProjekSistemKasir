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

Route::get('/', function () {
    return view('welcome');
});

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
Route::get("/kasir", "TransaksiController@index");
Route::get('/kasir/action', 'TransaksiController@action')->name('kasir.action');
Route::post('/kasir/detail', 'TransaksiController@detail')->name('kasir.detail');
Route::post('/kasir/hapus', 'TransaksiController@hapus')->name('kasir.hapus');
Route::post('/kasir/tambah', 'TransaksiController@tambah')->name('kasir.tambah');
Route::post('/kasir/batal', 'TransaksiController@batal')->name('kasir.batal');
Route::post('/kasir/tambahsatu', 'TransaksiController@tambahsatu')->name('kasir.tambahsatu');
Route::post('/kasir/kurangsatu', 'TransaksiController@kurangsatu')->name('kasir.kurangsatu');
// route owner
Route::get('/owner/laporan', 'OwnersController@index');
Route::get('/owner/laporan/{transaksi}', 'OwnersController@show');
Route::get('/owner/pendapatan', 'OwnersController@pendapatan');
// setting profile
Route::get('/profile', 'UsersController@profile');
Route::post('/profile/{user}/edit', 'UsersController@editprofile');
// manipulasi
Route::get('/manageakun', 'UsersController@manageindex');
Route::delete('/manageakun/{user}/delete', 'UsersController@managedelete');
Route::get('/manageakun/register', 'UsersController@manageregister');
Route::post('/manageakun/tambah', 'UsersController@managetambah');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
