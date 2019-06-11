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

Route::get('/', 'MainPageController@index')->name('index');

Route::get('/surf/login', 'SurfController@linkSurf')->middleware(['auth']);

Route::get('/account', 'AccountController@index')->middleware(['auth']);
Route::get('/account/linked', 'AccountController@linked');
Route::get('/account/company', 'AccountController@index');

Route::get('companies/register_company', 'Companies\CompanyController@showRegister')->name('register-company');
Route::post('/account', 'Companies\CompanyController@register')->name('register-company-action1');
Route::post('/companies/register_company', 'Companies\CompanyController@register')->name('register-company-action2');

Route::get('companies/login_company', 'Auth\CompanyLoginController@showLoginForm')->name('company-login');
Route::post('companies/login_company', 'Auth\CompanyLoginController@login')->name('company-login-submit');


Route::get('/companies/', 'Companies\CompanyController@companyList')->name('companies');
Route::get('/company/{id}', 'Companies\CompanyController@company')->name('company');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware(['auth']);

// Minors
Route::get('/minors', 'MinorController@List')->name('minors');
Route::get('/minor/{id}', 'MinorController@Minor')->name('minor');

Route::post('/minor/{id}', 'MinorController@InsertReview')->name('minor')->middleware(['auth']);
Route::delete('/minor/{id}', 'MinorController@DeleteReview')->name('review')->middleware(['auth']);

//Taal
Route::get('lang/{locale}', 'LocalizationController@index')->name('lang');

// Kaart
Route::get('/map', 'MapController@Map')->name('map');

// Organisaties
Route::get('/organisations', "OrganisationController@list")->name('organisations');
Route::get('/organisations/{id}', 'OrganisationController@Organisation')->name('organisation');

// Locaties
Route::get('/locations', "LocationController@list")->name('locations');
Route::get('/location/{id}', 'LocationController@Location')->name('location');

Route::get('/article/{id}','NewsController@Article')->name('article');

//
// Dashboard
Route::middleware(['admin'])->group(function(){
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
    Route::post('/dashboard/minors/create', 'Dashboard\MinorController@CreatePost');

    // Location list
    Route::get('/dashboard/locations', 'Dashboard\LocationController@Locations')->name('dashboard-locations');

    // Specific location
    Route::get('/dashboard/location/{id}', 'Dashboard\LocationController@Location')->name('dashboard-location');

    //Edit location
    Route::get('/dashboard/locations/{id}/edit', 'Dashboard\LocationController@Edit')->name('dashboard-location-edit');
    Route::post('/dashboard/locations/{id}/edit', 'Dashboard\LocationController@EditPost')->name('dashboard-location-edit');

    // Organisation list
    Route::get('/dashboard/organisations', 'Dashboard\OrganisationController@Organisations')->name('dashboard-organisations');

    // Specific organisation
    Route::get('/dashboard/organisations/{id}', 'Dashboard\OrganisationController@Organisation')->name('dashboard-organisation');

    // Delete organisation
    Route::delete('/dashboard/organisations/{id}', 'Dashboard\OrganisationController@Delete')->name('dashboard-organisation-delete');

    // Edit organisation
    Route::get('/dashboard/organisations/{id}/edit', 'Dashboard\OrganisationController@Edit')->name('dashboard-organisation-edit');
    Route::post('/dashboard/organisations/{id}/edit', 'Dashboard\OrganisationController@EditPost')->name('dashboard-organisation-edit');


    // Contact groups
    Route::get('/dashboard/contactgroups', 'Dashboard\ContactGroupController@ContactGroups')->name('dashboard-contactgroups');
    Route::get('/dashboard/contactgroup/{id}', 'Dashboard\ContactGroupController@ContactGroup')->name('dashboard-contactgroup');

    // Reviews
    Route::get('/dashboard/reviews', 'DashboardController@Reviews')->name('dashboard-reviews');
    // Users
    Route::get('/dashboard/users', 'Dashboard\UserController@Users')->name('dashboard-users');
    Route::get('/dashboard/users/{id}', 'Dashboard\UserController@User')->name('dashboard-user');
    Route::post('/dashboard/users/{id}', 'Dashboard\UserController@Edit')->name('dashboard-user-edit');

    Route::get('/dashboard/articles', 'Dashboard\NewsController@Articles')->name('dashboard-articles');
    Route::get('/dashboard/articles/{id}', 'Dashboard\NewsController@Article')->name('dashboard-article');
    Route::post('/dashboard/articles/{id}', 'Dashboard\NewsController@Edit')->name('dashboard-article-edit');
    Route::post('/dashboard/article/create', 'Dashboard\NewsController@Create')->name('dashboard-article-create');
    Route::get('/dashboard/article/create', 'Dashboard\NewsController@New')->name('dashboard-article-new');
    Route::get('/dashboard/article/{id}', 'Dashboard\NewsController@Delete')->name('dashboard-article-delete');



    // Dashboard importing
    Route::get('/dashboard/import', function() {
        return view('dashboard/import');
    })->name('import');

  
    // Import routes
    Route::get('/import/minors', 'ImportController@Minors');
    Route::get('/import/organizations', 'ImportController@Organisations');
    Route::get('/import/locations', 'ImportController@Locations');
    Route::get('/import/contactpersons', 'ImportController@ContactPersons');
    Route::get('/import/contactgroups', 'ImportController@ContactGroups');

    Route::get('/dashboard/dashboard_assessable', 'DashboardminorsController@Minors_to_assess')->name('assessable');

    Route::get('/dashboard/dashboard_assessed', 'DashboardminorsController@Assessed_minors')->name('assessed');

    Route::get('/dashboard/minor/{id}/reviews', 'DashboardminorsController@Minor')->name('dashboard-minor-reviews');

    Route::post('dashboard/minor/{id}/reviews', 'MinorController@InsertReview')->name('dashboard-minor-reviews');

    Route::get('dashboard/dashboard_merge_reviews/{id}', 'DashboardminorsController@MergeReviews')->name('dashboard-merge');

    Route::post('dashboard/dashboard_merge_reviews/{id}', 'DashboardminorsController@InsertReview')->name('dashboard-merge');


    Route::get('dashboard/analytics', function() {
        return view('dashboard/analytics');
    })->name('dashboard-merge');
});
