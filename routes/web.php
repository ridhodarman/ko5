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
Route::get('/cari/{jenis}/{kampus}/{teks}', 'PencarianController@keyword');

Route::get('/info', function () {  return abort(404); })->name('info');
Route::get('/info/{id}', 'PencarianController@show');

Route::get('/post', 'PostsController@index')->middleware('auth')->name('post');
Route::get('/post/tambah', 'PostsController@create')->middleware('auth');
Route::post('/post', 'PostsController@store')->middleware('auth');
Route::get('/post/{id}', 'PostsController@show')->middleware('auth');
Route::get('/post/{post}/edit', 'PostsController@edit')->middleware('auth');
Route::patch('/post/{post}/edit', 'PostsController@update')->middleware('auth');
Route::delete('/post/{post}', 'PostsController@destroy')->middleware('auth');
Route::delete('/post/{post}/cover', 'PostsController@destroy_cover')->middleware('auth');
Route::get('/post/{post}/cover', 'PostsController@edit_cover')->middleware('auth');
Route::patch('/post/{post}/cover', 'PostsController@update_cover')->middleware('auth');
Route::get('/post/kecamatan/{value}', 'PostsController@view')->middleware('auth');

Route::get('/detail_fasilitas_post', 'Detail_fasilitas_postsController@index')->middleware('auth')->name('detail_fasilitas_post');
Route::get('/detail_fasilitas_post/tambah/{post}', 'Detail_fasilitas_postsController@create')->middleware('auth');
Route::post('/detail_fasilitas_post', 'Detail_fasilitas_postsController@store')->middleware('auth');
//Route::get('/detail_fasilitas_post/{id}', 'Detail_fasilitas_postsController@show')->middleware('auth');
//Route::get('/detail_fasilitas_post/{detail_fasilitas_post_post}/edit', 'Detail_fasilitas_postsController@edit')->middleware('auth');
//Route::patch('/detail_fasilitas_post/{detail_fasilitas_post_post}/edit', 'Detail_fasilitas_postsController@update')->middleware('auth');
Route::delete('/detail_fasilitas_post/{detail_fasilitas_post}/{post}', 'Detail_fasilitas_postsController@destroy')->middleware('auth');

Route::get('/jenis', 'Jenis_postsController@index')->middleware('auth')->name('jenis');
Route::get('/jenis/tambah', 'Jenis_postsController@create')->middleware('auth');
Route::post('/jenis', 'Jenis_postsController@store')->middleware('auth');
Route::get('/jenis/{id}', 'Jenis_postsController@show')->middleware('auth');
Route::get('/jenis/{jenis_post}/edit', 'Jenis_postsController@edit')->middleware('auth');
Route::patch('/jenis/{jenis_post}/edit', 'Jenis_postsController@update')->middleware('auth');
Route::delete('/jenis/{jenis_post}', 'Jenis_postsController@destroy')->middleware('auth');

Route::get('/status', 'Status_postsController@index')->middleware('auth')->name('status');
Route::get('/status/tambah', 'Status_postsController@create')->middleware('auth');
Route::post('/status', 'Status_postsController@store')->middleware('auth');
Route::get('/status/{id}', 'Status_postsController@show')->middleware('auth');
Route::get('/status/{status_post}/edit', 'Status_postsController@edit')->middleware('auth');
Route::patch('/status/{status_post}/edit', 'Status_postsController@update')->middleware('auth');
Route::delete('/status/{status_post}', 'Status_postsController@destroy')->middleware('auth');

Route::get('/kecamatan', 'KecamatansController@index')->middleware('auth')->name('kecamatan');
Route::get('/kecamatan/tambah', 'KecamatansController@create')->middleware('auth');
Route::post('/kecamatan', 'KecamatansController@store')->middleware('auth');
Route::get('/kecamatan/{id}', 'KecamatansController@show')->middleware('auth');
Route::get('/kecamatan/{kecamatan}/edit', 'KecamatansController@edit')->middleware('auth');
Route::patch('/kecamatan/{kecamatan}/edit', 'KecamatansController@update')->middleware('auth');
Route::delete('/kecamatan/{kecamatan}', 'KecamatansController@destroy')->middleware('auth');

Route::get('/kelurahan', 'KelurahansController@index')->middleware('auth')->name('kelurahan');
Route::get('/kelurahan/tambah', 'KelurahansController@create')->middleware('auth');
Route::post('/kelurahan', 'KelurahansController@store')->middleware('auth');
Route::get('/kelurahan/{id}', 'KelurahansController@show')->middleware('auth');
Route::get('/kelurahan/{kelurahan}/edit', 'KelurahansController@edit')->middleware('auth');
Route::patch('/kelurahan/{kelurahan}/edit', 'KelurahansController@update')->middleware('auth');
Route::delete('/kelurahan/{kelurahan}', 'KelurahansController@destroy')->middleware('auth');
Route::get('/kelurahan/kecamatan/{value}', 'KelurahansController@view')->middleware('auth');

Route::get('/pemilik', 'PemiliksController@index')->middleware('auth')->name('pemilik');
Route::get('/pemilik/tambah', 'PemiliksController@create')->middleware('auth');
Route::post('/pemilik', 'PemiliksController@store')->middleware('auth');
Route::get('/pemilik/{id}', 'PemiliksController@show')->middleware('auth');
Route::get('/pemilik/{pemilik}/edit', 'PemiliksController@edit')->middleware('auth');
Route::patch('/pemilik/{pemilik}/edit', 'PemiliksController@update')->middleware('auth');
Route::delete('/pemilik/{pemilik}', 'PemiliksController@destroy')->middleware('auth');

Route::get('/kampus', 'Kampus_sekolahsController@index')->middleware('auth')->name('kampus');
Route::get('/kampus/tambah', 'Kampus_sekolahsController@create')->middleware('auth');
Route::post('/kampus', 'Kampus_sekolahsController@store')->middleware('auth');
Route::get('/kampus/{id}', 'Kampus_sekolahsController@show')->middleware('auth');
Route::get('/kampus/{kampus_sekolah}/edit', 'Kampus_sekolahsController@edit')->middleware('auth');
Route::patch('/kampus/{kampus_sekolah}/edit', 'Kampus_sekolahsController@update')->middleware('auth');
Route::delete('/kampus/{kampus_sekolah}', 'Kampus_sekolahsController@destroy')->middleware('auth');

Route::get('/fasilitas', 'Fasilitas_postsController@index')->middleware('auth')->name('fasilitas');
Route::get('/fasilitas/tambah', 'Fasilitas_postsController@create')->middleware('auth');
Route::post('/fasilitas', 'Fasilitas_postsController@store')->middleware('auth');
Route::get('/fasilitas/{id}', 'Fasilitas_postsController@show')->middleware('auth');
Route::get('/fasilitas/{fasilitas_post}/edit', 'Fasilitas_postsController@edit')->middleware('auth');
Route::patch('/fasilitas/{fasilitas_post}/edit', 'Fasilitas_postsController@update')->middleware('auth');
Route::delete('/fasilitas/{fasilitas_post}', 'Fasilitas_postsController@destroy')->middleware('auth');