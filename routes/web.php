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

use Illuminate\Support\Facades\Route;

Route::get('/', 'MainPageController@Home')->name('home');

// Minors
Route::get('/minors', 'MinorController@List')->name('minors');
Route::get('/minor/{id}', 'MinorController@Minor')->name('minor');
Route::post('/minor/{id}', 'MinorController@InsertReview')->name('minor');

//Taal
Route::get('/lang/{lang}', function ($lang) {
    setcookie('lang', $lang, time() + 60 * 60 * 24 * 30, '/');

    return redirect(route('home'));
})->name('lang');


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
});
Route::get('/import/minors', 'ImportController@Minors');
Route::get('/import/organizations', 'ImportController@Organisations');
Route::get('/import/locations', 'ImportController@Locations');