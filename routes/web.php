<?php

use Illuminate\Support\Facades\Route;

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
    return view('site.dashboard.dashboardView');
});

Route::get('/employees', function () {
    return view('site.people.Employees.employeesView');
});
Route::get('/delegates', function () {
    return view('site.people.Delegates.delegatesView');
});
Route::get('/costumers', function () {
    return view('site.people.Costumers.costumersView');
});
Route::get('/permission', function () {
    return view('site.settings.Permissions.permissions');
});
Route::get('/shipments', function () {
    return view('site.shipments.shipmentsView');
});
Route::get('/subCities', function () {
    return view('site.sub_cities.subCitiesView');
});
Route::get('/rightsView', function () {
    return view('site.settings.Permissions.Rights/rightsView');
});
Route::get('/status', function () {
    return view('site.settings.status.statusView');
});
Route::get('/reasonsView', function () {
    return view('site.settings.status.reasonsView');
});
Route::get('/branches', function () {
    return view('site.Branches.branchesView');
});
Route::get('/pricesView', function () {
    return view('site.Branches.DeliveryPreices.pricesView');
});
Route::get('/modalPrice.addFormPrices', function () {
    return view('site.Branches.DeliveryPreices.addFormPrices');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});