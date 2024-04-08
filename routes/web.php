<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchesController;
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
    return view('site.People.Employees.employeesView');
});
Route::get('/delegates', function () {
    return view('site.People.Delegates.delegatesView');
});
Route::get('/costumers', function () {
    return view('site.People.Customers.customersView');
});
Route::get('/permission', function () {
    return view('site.settings.Permissions.permissionsView');
});
Route::get('//matirialPermission', function () {
    return view('site.settings.Permissions.MatirialPermission.matirialPermissionView');
});
Route::get('/shipments', function () {
    return view('site.shipments.shipmentsView');
});
Route::get('/subCities', function () {
    return view('site.SubCities.subCitiesView');
});
Route::get('/status', function () {
    return view('site.Settings.TypeStatus.typeStatusView');
});
Route::resource('/branches', BranchesController::class);

// Route::resource('/branches.pricesView/{id}', BranchesController::class, '/branches.pricesView');
Route::get('/branches/pricesView/{id}', [BranchesController::class, 'pricesView'])->name('branches.pricesView');
Route::get('/branches/addFormPrices/{id}', [BranchesController::class, 'addFormPrices'])->name('branches.addFormPrices');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });