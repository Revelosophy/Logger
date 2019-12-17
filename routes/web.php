<?php

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
Route::get('/', 'PostController@index')->name('post.index')->middleware('auth');

Route::get('create', 'PostController@create')->name('post.create')->middleware('auth');

Route::post('create', 'PostController@store')->name('post.store')->middleware('auth');

Route::post('/', 'ReplyController@store')->name('reply.store')->middleware('auth');

Route::delete('/delete','PostController@destroy')->name('post.delete')->middleware('auth');


Route::get('/logout', 'Auth\LoginController@logout');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
