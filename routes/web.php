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

Route::get('create', 'DataController@create')->name('data.create')->middleware('auth');

Route::post('create', 'DataController@store')->name('data.store')->middleware('auth');

Route::get('/', 'DataController@index')->name ('data.index')->middleware('auth');

Route::get('/logout', 'Auth\LoginController@logout');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
