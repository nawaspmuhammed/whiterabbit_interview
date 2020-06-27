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

Route::get('/','DirectoryController@index')->name('index');
Route::get('/create', "DirectoryController@create")->name('create');;
Route::post('save','DirectoryController@save')->name('save_file');
Route::delete('{file}/destroy', 'DirectoryController@destroy')->name('destroy');
Route::get('filehistory', 'DirectoryController@filehistory')->name('filehistory');