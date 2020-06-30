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
Route::get('/post-detail/{post}', 'PostsController@show')->middleware('auth');
Route::get('/post-tambah', function () { return view('admin.post.tambah'); })->middleware('auth');
Route::get('/post-tambah', 'PostsController@view_add')->middleware('auth');
Route::post('/post', 'PostsController@store')->middleware('auth');
Route::get('/post/{post}', 'PostsController@view_edit')->middleware('auth');

Route::get('/jenis', 'Jenis_postsController@index')->middleware('auth');
Route::get('/jenis-detail/{jenis}', 'Jenis_postsController@show')->middleware('auth');

Route::get('/status', 'Status_postsController@index')->middleware('auth');
Route::get('/status-detail/{status}', 'Status_postsController@show')->middleware('auth');