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
});

Route::get('/surf/login', 'SurfController@linkSurf')->middleware(['auth']);
 
Route::get('/account', 'AccountController@index')->middleware(['auth']);
Route::get('/account/linked', 'AccountController@linked');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware(['auth']);

Route::get('/minors', 'MinorController@List')->name('minors');

Route::get('/minor/{id}', 'MinorController@Minor')->name('minor');
Route::post('/minor/{id}', 'MinorController@InsertReview')->name('minor');

Route::get('/organisation/{id}', 'MinorController@Minor')->name('organisation');

Route::get('/import', function() {
    return view('dashboard/import');
})->name('organisation');

Route::get('/import/minors', 'ImportController@Minors');
