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

// Minors
Route::get('/minors', 'MinorController@List')->name('minors');
Route::get('/minor/{id}', 'MinorController@Minor')->name('minor');
// TODO review controller
Route::post('/minor/{id}', 'MinorController@InsertReview')->name('minor');
Route::delete('/minor/{id}', 'MinorController@DeleteReview')->name('review');

// Kaart
Route::get('/map', 'MapController@Map')->name('map');


// Organisaties
Route::get('/organisations', "OrganisationController@list")->name('organisations');
Route::get('/organisation/{id}', 'OrganisationController@Organisation')->name('organisation');

// Locaties
Route::get('/locations', "LocationController@list")->name('locations');
Route::get('/location/{id}', 'LocationController@Location')->name('location');


// Temporary Importing
Route::get('/import', function() {
    return view('dashboard/import');
})->name('organisation');

Route::get('/import/minors', 'ImportController@Minors');
Route::get('/import/organizations', 'ImportController@Organisations');
Route::get('/import/locations', 'ImportController@Locations');
