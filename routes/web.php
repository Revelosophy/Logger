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

Route::get('/', function () {
    return view('landing', ['name' => "unknown user"]);
});


Route::get('create', 'DataController@create')->name('data.create');

Route::post('create', 'DataController@store')->name('data.store');

Route::get('/{name}', function ($name) {
    return view('landing', ['name' => $name]);
});
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
