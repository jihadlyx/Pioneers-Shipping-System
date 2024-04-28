<?php

use App\Http\Controllers\BranchesController;
use App\Http\Controllers\CostumersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DelegatesController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\MaterialRolesController;
use App\Http\Controllers\PriceBranchesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ShipmentsController;
use App\Http\Controllers\SubCitiesController;
use App\Http\Controllers\TypeStatusController;
use App\Http\Middleware\CheckShowPermission;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('site.auth.Login.login');
});

Route::middleware('auth')->group(function () {


    Route::middleware('CheckShowPermission')->group(function () {
        Route::get('/branches/{page_id}', [BranchesController::class, 'index'])->name('branches.index');
        Route::get('/branches/price/show/{page_id}/{id_branch}', [PriceBranchesController::class, 'show'])->name('branches.price.show');
        Route::get('/branches/price/{page_id}/{id_branch}', [PriceBranchesController::class, 'edit'])->name('branches.price.edit');
        Route::get('/branches/view/{page_id}/{id_branch}', [PriceBranchesController::class, 'index'])->name('branches.view.index');

        Route::get('/employees/{page_id}', [EmployeesController::class, 'index'])->name('employees.index');
        Route::get('/dashboard/{page_id}', [DashboardController::class, 'index'])->name('.index');
        Route::get('/delegates/{page_id}', [DelegatesController::class, 'index'])->name('delegates.index');
        Route::get('/customers/{page_id}', [CostumersController::class, 'index'])->name('customers.index');
        Route::get('/shipments/{page_id}', [ShipmentsController::class, 'index'])->name('shipments.index');
        Route::get('/subCities/{page_id}', [SubCitiesController::class, 'index'])->name('subCities.index');
        Route::get('/status/{page_id}', [TypeStatusController::class, 'index'])->name('status.index');
        Route::get('/roles/{page_id}', [RolesController::class, 'index'])->name('roles.index');
        Route::get('/materialRoles/{page_id}', [MaterialRolesController::class, 'index'])->name('materialRoles.index');
        Route::get('/materialRoles/show/{page_id}', [MaterialRolesController::class, 'show'])->name('materialRoles.show');
    });

    Route::middleware('CheckCreatePermission')->group(function () {
        Route::post('/branches/create/{page_id}', [BranchesController::class, 'store'])->name('branches.store');

        Route::post('/employees/create/{page_id}', [EmployeesController::class, 'store'])->name('employees.store');
        Route::post('/delegates/create/{page_id}', [DelegatesController::class, 'store'])->name('delegates.store');
        Route::post('/customers/create/{page_id}', [CostumersController::class, 'store'])->name('customers.store');
        Route::post('/shipments/create/{page_id}', [ShipmentsController::class, 'store'])->name('shipments.store');


        Route::post('/branches/price/addPrices/{page_id}/{id}', [PriceBranchesController::class, 'store'])->name('branches.price.store');
        Route::post('/employees/create/{page_id}', [EmployeesController::class, 'store'])->name('employees.store');
        Route::post('/roles/create/{page_id}', [RolesController::class, 'store'])->name('roles.store');
        Route::post('/materialRoles/{page_id}', [MaterialRolesController::class, 'store'])->name('materialRoles.store');
    });

    Route::middleware('CheckUpdatePermission')->group(function () {
        Route::patch('/branches/{page_id}', [BranchesController::class, 'update'])->name('branches.update');
        Route::patch('/branches/{page_id}/{id_branch}', [BranchesController::class, 'update'])->name('branches.update');

        Route::patch('/delegates/{page_id}/{id_delegate}', [DelegatesController::class, 'update'])->name('delegates.update');
        Route::patch('/customers/{page_id}/{id_customer}', [CostumersController::class, 'update'])->name('customers.update');
        Route::patch('/shipments/{page_id}/{id_ship}', [ShipmentsController::class, 'update'])->name('shipments.update');


        Route::patch('/employees/{page_id}/{id_emp}', [EmployeesController::class, 'update'])->name('employees.update');
        Route::patch('/roles/update/{page_id}/{id_role}', [RolesController::class, 'update'])->name('roles.update');
        Route::patch('/roles/material/edit/{page_id}/{id_role}', [MaterialRolesController::class, 'edit'])->name('materialRoles.edit');
    });

    Route::middleware('CheckDeletePermission')->group(function () {
        Route::delete('/branches/{page_id}', [BranchesController::class, 'destroy'])->name('branches.destroy');
        Route::delete('/branches/{page_id}/{id_branch}', [BranchesController::class, 'destroy'])->name('branches.destroy');
        Route::delete('/employees/{page_id}/{id_emp}', [EmployeesController::class, 'destroy'])->name('employees.destroy');
        Route::delete('/roles/destroy/{page_id}/{id_role}', [RolesController::class, 'destroy'])->name('roles.destroy');


        Route::delete('/delegates/{page_id}/{id_delegate}', [DelegatesController::class, 'destroy'])->name('delegates.destroy');
        Route::delete('/customers/{page_id}/{id_customer}', [CostumersController::class, 'destroy'])->name('customers.destroy');
        Route::delete('/shipments/{page_id}/{id_ship}', [ShipmentsController::class, 'destroy'])->name('shipments.destroy');

    });

    Route::get('/branches/pricesView/{id}', [BranchesController::class, 'pricesView'])->name('branches.pricesView');
    Route::get('/branches/addFormPrices/{id}', [BranchesController::class, 'addFormPrices'])->name('branches.addFormPrices');


});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
