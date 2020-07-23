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

Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/sidebar', 'PencarianController@sidebar')->name('sidebar');
Route::get('/cari', 'PencarianController@index')->name('cari');
Route::get('/cari/{lat}/{lng}/{teks}', 'PencarianController@keyword');
Route::post('/cari/nama', 'PencarianController@nama');
Route::post('/cari', 'PencarianController@cari');

Route::get('/info', function () {  return abort(404); })->name('info');
Route::get('/info/{id}', 'PencarianController@show');

Route::middleware(['cekstatus'])->group(function () {
    Route::get('/post', 'PostsController@index')->name('post');
    Route::get('/post/tambah', 'PostsController@create');
    Route::post('/post', 'PostsController@store');
    Route::get('/post/{id}', 'PostsController@show');
    Route::get('/post/{post}/edit', 'PostsController@edit');
    Route::patch('/post/{post}/edit', 'PostsController@update');
    Route::delete('/post/{post}', 'PostsController@destroy');
    Route::delete('/post/{post}/cover', 'PostsController@destroy_cover');
    Route::get('/post/{post}/cover', 'PostsController@edit_cover');
    Route::patch('/post/{post}/cover', 'PostsController@update_cover');
    Route::get('/post/kecamatan/{value}', 'PostsController@view');

    Route::get('/jenis', 'Jenis_postsController@index')->name('jenis');
    Route::get('/jenis/tambah', 'Jenis_postsController@create');
    Route::post('/jenis', 'Jenis_postsController@store');
    Route::get('/jenis/{id}', 'Jenis_postsController@show');
    Route::get('/jenis/{jenis_post}/edit', 'Jenis_postsController@edit');
    Route::patch('/jenis/{jenis_post}/edit', 'Jenis_postsController@update');
    Route::delete('/jenis/{jenis_post}', 'Jenis_postsController@destroy');

    Route::get('/status', 'Status_postsController@index')->name('status');
    Route::get('/status/tambah', 'Status_postsController@create');
    Route::post('/status', 'Status_postsController@store');
    Route::get('/status/{id}', 'Status_postsController@show');
    Route::get('/status/{status_post}/edit', 'Status_postsController@edit');
    Route::patch('/status/{status_post}/edit', 'Status_postsController@update');
    Route::delete('/status/{status_post}', 'Status_postsController@destroy');

    Route::get('/kecamatan', 'KecamatansController@index')->name('kecamatan');
    Route::get('/kecamatan/tambah', 'KecamatansController@create');
    Route::post('/kecamatan', 'KecamatansController@store');
    Route::get('/kecamatan/{id}', 'KecamatansController@show');
    Route::get('/kecamatan/{kecamatan}/edit', 'KecamatansController@edit');
    Route::patch('/kecamatan/{kecamatan}/edit', 'KecamatansController@update');
    Route::delete('/kecamatan/{kecamatan}', 'KecamatansController@destroy');

    Route::get('/kelurahan', 'KelurahansController@index')->name('kelurahan');
    Route::get('/kelurahan/tambah', 'KelurahansController@create');
    Route::post('/kelurahan', 'KelurahansController@store');
    Route::get('/kelurahan/{id}', 'KelurahansController@show');
    Route::get('/kelurahan/{kelurahan}/edit', 'KelurahansController@edit');
    Route::patch('/kelurahan/{kelurahan}/edit', 'KelurahansController@update');
    Route::delete('/kelurahan/{kelurahan}', 'KelurahansController@destroy');
    Route::get('/kelurahan/kecamatan/{value}', 'KelurahansController@view');

    Route::get('/pemilik', 'PemiliksController@index')->name('pemilik');
    Route::get('/pemilik/tambah', 'PemiliksController@create');
    Route::post('/pemilik', 'PemiliksController@store');
    Route::get('/pemilik/{id}', 'PemiliksController@show');
    Route::get('/pemilik/{pemilik}/edit', 'PemiliksController@edit');
    Route::patch('/pemilik/{pemilik}/edit', 'PemiliksController@update');
    Route::delete('/pemilik/{pemilik}', 'PemiliksController@destroy');

    Route::get('/kampus', 'Kampus_sekolahsController@index')->name('kampus');
    Route::get('/kampus/tambah', 'Kampus_sekolahsController@create');
    Route::post('/kampus', 'Kampus_sekolahsController@store');
    Route::get('/kampus/{id}', 'Kampus_sekolahsController@show');
    Route::get('/kampus/{kampus_sekolah}/edit', 'Kampus_sekolahsController@edit');
    Route::patch('/kampus/{kampus_sekolah}/edit', 'Kampus_sekolahsController@update');
    Route::delete('/kampus/{kampus_sekolah}', 'Kampus_sekolahsController@destroy');

    Route::get('/fasilitas', 'Fasilitas_postsController@index')->name('fasilitas');
    Route::get('/fasilitas/tambah', 'Fasilitas_postsController@create');
    Route::post('/fasilitas', 'Fasilitas_postsController@store');
    Route::get('/fasilitas/{id}', 'Fasilitas_postsController@show');
    Route::get('/fasilitas/{fasilitas_post}/edit', 'Fasilitas_postsController@edit');
    Route::patch('/fasilitas/{fasilitas_post}/edit', 'Fasilitas_postsController@update');
    Route::delete('/fasilitas/{fasilitas_post}', 'Fasilitas_postsController@destroy');

    Route::get('/detail_fasilitas_post', 'Detail_fasilitas_postsController@index')->name('detail_fasilitas_post');
    Route::get('/detail_fasilitas_post/tambah/{post}', 'Detail_fasilitas_postsController@create');
    Route::post('/detail_fasilitas_post', 'Detail_fasilitas_postsController@store');
    //Route::get('/detail_fasilitas_post/{id}', 'Detail_fasilitas_postsController@show');
    //Route::get('/detail_fasilitas_post/{detail_fasilitas_post_post}/edit', 'Detail_fasilitas_postsController@edit');
    //Route::patch('/detail_fasilitas_post/{detail_fasilitas_post_post}/edit', 'Detail_fasilitas_postsController@update');
    Route::delete('/detail_fasilitas_post/{detail_fasilitas_post}', 'Detail_fasilitas_postsController@destroy');

    Route::get('/harga', 'HargasController@index')->name('harga');
    Route::get('/harga/tambah/{post}', 'HargasController@create');
    Route::post('/harga', 'HargasController@store');
    Route::delete('/harga/{harga}', 'HargasController@destroy');

    Route::get('/foto', 'FotosController@index')->name('foto');
    Route::get('/foto/tambah/{post}', 'FotosController@create');
    Route::post('/fotos', 'FotosController@store')->name('fotos');
    Route::delete('/foto/{foto}', 'FotosController@destroy');

    Route::get('/kamar', 'KamarsController@index')->name('kamar');
    Route::get('/kamar/tambah/{post}', 'KamarsController@create');
    Route::post('/kamar', 'KamarsController@store');
    Route::delete('/kamar/{kamar}', 'KamarsController@destroy');
});