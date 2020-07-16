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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/cari', function () {  return view('cari.index'); })->name('cari');

Route::get('/post', 'PostsController@index')->middleware('auth')->name('post');
Route::get('/post/tambah', 'PostsController@create')->middleware('auth');
Route::post('/post', 'PostsController@store')->middleware('auth');
Route::get('/post/{id}', 'PostsController@show')->middleware('auth');
Route::get('/post/{post}/edit', 'PostsController@edit')->middleware('auth');
Route::patch('/post/{post}/edit', 'PostsController@update')->middleware('auth');
Route::delete('/post/{post}', 'PostsController@destroy')->middleware('auth');
Route::delete('/post/{post}/foto', 'PostsController@destroy_foto')->middleware('auth');
Route::get('/post/{post}/foto', 'PostsController@edit_foto')->middleware('auth');
Route::patch('/post/{post}/foto', 'PostsController@update_foto')->middleware('auth');
Route::get('/post/kecamatan/{value}', 'PostsController@view')->middleware('auth');

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