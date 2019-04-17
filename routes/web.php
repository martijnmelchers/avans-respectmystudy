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

// Minors
Route::get('/minors', 'MinorController@List')->name('minors');
Route::get('/minor/{id}', 'MinorController@Minor')->name('minor');
Route::post('/minor/{id}', 'MinorController@InsertReview')->name('minor');

// Kaart
Route::get('/map', 'MapController@Map')->name('map');


// Organisaties
Route::get('/organisations', "OrganisationController@list")->name('organisations');
Route::get('/organisation/{id}', 'OrganisationController@Organisation')->name('organisation');

// Locaties
Route::get('/locations', "LocationController@list")->name('locations');
Route::get('/location/{id}', 'LocationController@Location')->name('location');


// Dashboard
Route::get('/dashboard', 'DashboardController@Home')->name('dashboard');

Route::get('/dashboard/minors', 'Dashboard\MinorController@Minors')->name('dashboard-minors');
Route::get('/dashboard/minors/{id}', 'Dashboard\MinorController@Minor')->name('dashboard-minor');
Route::get('/dashboard/minors/{id}/edit', 'Dashboard\MinorController@Edit')->name('dashboard-minor-edit');
Route::post('/dashboard/minors/{id}/edit', 'Dashboard\MinorController@EditPost')->name('dashboard-minor-edit');

Route::get('/dashboard/locations', 'Dashboard\LocationController@Locations')->name('dashboard-locations');
Route::get('/dashboard/locations/{id}', 'Dashboard\LocationController@Location')->name('dashboard-location');

Route::get('/dashboard/organisations', 'DashboardController@Organisations')->name('dashboard-organisations');
Route::get('/dashboard/organisations/{id}', 'DashboardController@Organisation')->name('dashboard-organisation');

Route::get('/dashboard/reviews', 'DashboardController@Reviews')->name('dashboard-reviews');

// Temporary Importing
Route::get('/dashboard/import', function() {
    return view('dashboard/import');
})->name('import');

Route::get('/import/minors', 'ImportController@Minors');
Route::get('/import/organizations', 'ImportController@Organisations');
Route::get('/import/locations', 'ImportController@Locations');