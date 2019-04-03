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
    return view('welcome');
})->name('home');

Route::get('/minors', 'MinorController@List')->name('minors');

Route::get('/minor/{id}', 'MinorController@Minor')->name('minor');

Route::get('/organisation/{id}', 'MinorController@Minor')->name('organisation');

Route::get('/import', function() {
    return view('dashboard/import');
})->name('organisation');

Route::get('/import/minors', 'ImportController@Minors');