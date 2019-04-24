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
Route::post('/minor/{id}', 'MinorController@InsertReview')->name('minor');

// Kaart
Route::get('/map', 'MapController@Map')->name('map');


// Organisaties
Route::get('/organisations', "OrganisationController@list")->name('organisations');
Route::get('/organisation/{id}', 'OrganisationController@Organisation')->name('organisation');

// Locaties
Route::get('/locations', "LocationController@list")->name('locations');
Route::get('/location/{id}', 'LocationController@Location')->name('location');


//
// Dashboard
Route::middleware(['auth'])->group(function(){
    // Home
    Route::get('/dashboard', 'DashboardController@Home')->name('dashboard');

    // Minor list
    Route::get('/dashboard/minors', 'Dashboard\MinorController@Minors')->name('dashboard-minors');

    // Specific minor
    Route::get('/dashboard/minor/{id}', 'Dashboard\MinorController@Minor')->name('dashboard-minor');

    // Minor versions
    Route::get('/dashboard/minor/{id}/versions', 'Dashboard\MinorController@Versions')->name('dashboard-minor-versions');

    // Create new version of existing minor
    Route::get('/dashboard/minor/{id}/newversion', 'Dashboard\MinorController@MinorNewversion')->name('dashboard-minor-newversion');

    // Edit minor
    Route::get('/dashboard/minor/{id}/edit', 'Dashboard\MinorController@Edit')->name('dashboard-minor-edit');
    Route::post('/dashboard/minor/{id}/edit', 'Dashboard\MinorController@EditPost')->name('dashboard-minor-edit');

    // Create new minor
    Route::get('/dashboard/minors/create', 'Dashboard\MinorController@Create')->name('dashboard-minor-create');
    Route::post('/dashboard/minors/create', 'Dashboard\MinorController@CreatePost')->name('dashboard-minor-create');

    // Location list
    Route::get('/dashboard/locations', 'Dashboard\LocationController@Locations')->name('dashboard-locations');

    // Specific location
    Route::get('/dashboard/locations/{id}', 'Dashboard\LocationController@Location')->name('dashboard-location');

    // Organisation list
    Route::get('/dashboard/organisations', 'DashboardController@Organisations')->name('dashboard-organisations');

    // Specific organisation
    Route::get('/dashboard/organisations/{id}', 'DashboardController@Organisation')->name('dashboard-organisation');

    // Reviews
    Route::get('/dashboard/reviews', 'DashboardController@Reviews')->name('dashboard-reviews');

    // Temporary Importing
    Route::get('/dashboard/import', function() {
        return view('dashboard/import');
    })->name('import');
});


Route::get('/import/minors', 'ImportController@Minors');
Route::get('/import/organizations', 'ImportController@Organisations');
Route::get('/import/locations', 'ImportController@Locations');
