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

Route::get('/', 'GridController@getIndex')->name('grid.show');;
Route::get('/grid/data', 'GridController@getData')->name('grid.show');;
Route::post('/grid/create', 'GridController@postData')->name('grid.create');;
Route::post('/grid/edit', 'GridController@postUpdateData')->name('grid.edit');;
Route::post('/grid/delete/{id}', 'GridController@deleteData')->name('grid.delete');;
