<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home.index');

Route::post('/', 'HomeController@store')->name('home.store');
Route::get('/{id}/delete', 'HomeController@destory')->name('home.destory');
Route::get('/{id}/download', 'HomeController@download')->name('home.download');


