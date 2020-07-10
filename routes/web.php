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

Route::get('/post', 'PostsController@index')->middleware('auth');
Route::get('/post/tambah', function () { return view('admin.post.tambah'); })->middleware('auth');
Route::get('/post-detail/{post}', 'PostsController@show')->middleware('auth');

Route::get('/post-tambah', 'PostsController@view_add')->middleware('auth');
Route::post('/post', 'PostsController@store')->middleware('auth');
Route::get('/post/{post}', 'PostsController@view_edit')->middleware('auth');

Route::get('/jenis', 'Jenis_postsController@index')->middleware('auth');
Route::get('/jenis/tambah', 'Jenis_postsController@create')->middleware('auth');
Route::post('/jenis', 'Jenis_postsController@store')->middleware('auth');
Route::get('/jenis/{id}', 'Jenis_postsController@show')->middleware('auth');
Route::get('/jenis/{jenis_post}/edit', 'Jenis_postsController@edit')->middleware('auth');
Route::patch('/jenis/{jenis_post}/edit', 'Jenis_postsController@update')->middleware('auth');
Route::delete('/jenis/{jenis_post}', 'Jenis_postsController@destroy')->middleware('auth');

Route::get('/status', 'Status_postsController@index')->middleware('auth');
Route::get('/status/tambah', 'Status_postsController@create')->middleware('auth');
Route::post('/status', 'Status_postsController@store')->middleware('auth');
Route::get('/status/{id}', 'Status_postsController@show')->middleware('auth');
Route::get('/status/{status_post}/edit', 'Status_postsController@edit')->middleware('auth');
Route::patch('/status/{status_post}/edit', 'Status_postsController@update')->middleware('auth');
Route::delete('/status/{status_post}', 'Status_postsController@destroy')->middleware('auth');

Route::get('/kecamatan', 'KecamatansController@index')->middleware('auth');
Route::get('/kecamatan/tambah', 'KecamatansController@create')->middleware('auth');
Route::post('/kecamatan', 'KecamatansController@store')->middleware('auth');
Route::get('/kecamatan/{id}', 'KecamatansController@show')->middleware('auth');
Route::get('/kecamatan/{kecamatan}/edit', 'KecamatansController@edit')->middleware('auth');
Route::patch('/kecamatan/{kecamatan}/edit', 'KecamatansController@update')->middleware('auth');
Route::delete('/kecamatan/{kecamatan}', 'KecamatansController@destroy')->middleware('auth');

Route::get('/kelurahan', 'KelurahansController@index')->middleware('auth');
Route::get('/kelurahan/tambah', 'KelurahansController@create')->middleware('auth');
Route::post('/kelurahan', 'KelurahansController@store')->middleware('auth');
Route::get('/kelurahan/{id}', 'KelurahansController@show')->middleware('auth');
Route::get('/kelurahan/{kelurahan}/edit', 'KelurahansController@edit')->middleware('auth');
Route::patch('/kelurahan/{kelurahan}/edit', 'KelurahansController@update')->middleware('auth');
Route::delete('/kelurahan/{kelurahan}', 'KelurahansController@destroy')->middleware('auth');