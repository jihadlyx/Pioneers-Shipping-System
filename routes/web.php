<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
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
use App\Http\Controllers\StatusShipmentsController;
use App\Http\Controllers\SubCitiesController;
use App\Http\Controllers\TypeStatusController;
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
    Route::get('/profile', function () {

    });
    Route::middleware('CheckShowPermission')->group(function () {
//      Branches
        Route::get('/branches/{page_id}', [BranchesController::class, 'index'])->name('branches.index');
        Route::get('/trash/branches/{page_id}', [BranchesController::class, 'getTrash'])->name('branches.trash.getTrash');
        Route::get('/branches/price/show/{page_id}/{id_branch}', [PriceBranchesController::class, 'show'])->name('branches.price.show');
        Route::get('/branches/price/{page_id}/{id_branch}', [PriceBranchesController::class, 'edit'])->name('branches.price.edit');
        Route::get('/branches/view/{page_id}/{id_branch}', [PriceBranchesController::class, 'index'])->name('branches.view.index');
        Route::get('/branches/pricesView/{id}', [BranchesController::class, 'pricesView'])->name('branches.pricesView');
        Route::get('/branches/addFormPrices/{id}', [BranchesController::class, 'addFormPrices'])->name('branches.addFormPrices');
//      Employees
        Route::get('/employees/{page_id}', [EmployeesController::class, 'index'])->name('employees.index');
        Route::get('/trash/employees/{page_id}', [EmployeesController::class, 'getTrash'])->name('employees.getTrash');
//      Delegates
        Route::get('/delegates/{page_id}', [DelegatesController::class, 'index'])->name('delegates.index');
        Route::get('/trash/delegates/{page_id}', [DelegatesController::class, 'getTrash'])->name('delegates.getTrash');
//      Customers
        Route::get('/customers/{page_id}', [CostumersController::class, 'index'])->name('customers.index');
        Route::get('/trash/customers/{page_id}', [CostumersController::class, 'getTrash'])->name('customers.getTrash');
//      Shipments
        Route::get('/shipments/{page_id}/{id_status}', [ShipmentsController::class, 'index'])->name('shipments.index');
        Route::get('/trash/shipments/{page_id}', [ShipmentsController::class, 'getTrash'])->name('shipments.getTrash');
        Route::get('/shipments/download/{page_id}/{id_ship}', [ShipmentsController::class, 'downloadShipmentData'])->name('shipments.downloadShipmentData');
        Route::get('/statusShipments/{page_id}', [StatusShipmentsController::class, 'index'])->name('statuses.index');
//      SubCities
        Route::get('/subCities/{page_id}', [SubCitiesController::class, 'index'])->name('subCities.index');
        Route::get('/trash/subCities/{page_id}', [SubCitiesController::class, 'getTrash'])->name('subCities.getTrash');
        Route::get('/subCities/{page_id}/{id_city}', [PriceBranchesController::class, 'show'])->name('subCities.show');
//      Roles
        Route::get('/roles/{page_id}', [RolesController::class, 'index'])->name('roles.index');
        Route::get('/trash/roles/{page_id}', [RolesController::class, 'getTrash'])->name('roles.getTrash');
        Route::get('/materialRoles/{page_id}', [MaterialRolesController::class, 'index'])->name('materialRoles.index');
        Route::get('/materialRoles/show/{page_id}/{id_role}', [MaterialRolesController::class, 'show'])->name('materialRoles.show');
//      Dashboard
        Route::get('/dashboard/{page_id}', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/dashboard/shipments/{page_id}/{id_status}', [DashboardController::class, 'show'])->name('dashboard.show');
//      Status
        Route::get('/status/{page_id}', [TypeStatusController::class, 'index'])->name('status.index');

    });

    Route::middleware('CheckCreatePermission')->group(function () {
        Route::post('/branches/create/{page_id}', [BranchesController::class, 'store'])->name('branches.store');
        Route::post('/branches/price/addPrices/{page_id}/{id}', [PriceBranchesController::class, 'store'])->name('branches.price.store');

        Route::post('/employees/create/{page_id}', [EmployeesController::class, 'store'])->name('employees.store');

        Route::post('/delegates/create/{page_id}', [DelegatesController::class, 'store'])->name('delegates.store');

        Route::post('/customers/create/{page_id}', [CostumersController::class, 'store'])->name('customers.store');

        Route::post('/shipments/create/{page_id}', [ShipmentsController::class, 'store'])->name('shipments.store');
        Route::post('/shipments/status/create/{page_id}', [StatusShipmentsController::class, 'store'])->name('status.shipments.store');

        Route::post('/roles/create/{page_id}', [RolesController::class, 'store'])->name('roles.store');
        Route::post('/materialRoles/{page_id}', [MaterialRolesController::class, 'store'])->name('materialRoles.store');

        Route::post('/subCities/create/{page_id}', [SubCitiesController::class, 'store'])->name('subCities.store');

        Route::post('/status/create/{page_id}', [TypeStatusController::class, 'store'])->name('status.store');
    });

    Route::middleware('CheckUpdatePermission')->group(function () {
//      Branches
        Route::patch('/branches/update/{page_id}/{id_branch}', [BranchesController::class, 'update'])->name('branches.update');
        Route::patch('/branches/translate/{page_id}/{id_branch}', [BranchesController::class, 'translate'])->name('branches.translate');
        Route::patch('/trash/branches/restore/{page_id}/{id_branch}', [BranchesController::class, 'restore'])->name('branches.trash.restore');
//      Employees
        Route::patch('/employees/{page_id}/{id_emp}', [EmployeesController::class, 'update'])->name('employees.update');
        Route::patch('/trash/employees/restore/{page_id}/{id_emp}', [EmployeesController::class, 'restore'])->name('employees.restore');
//      Delegates
        Route::patch('/delegates/{page_id}/{id_delegate}', [DelegatesController::class, 'update'])->name('delegates.update');
        Route::patch('/trash/delegates/restore/{page_id}/{id_delegate}', [DelegatesController::class, 'restore'])->name('delegates.restore');
//      Customers
        Route::patch('/customers/{page_id}/{id_customer}', [CostumersController::class, 'update'])->name('customers.update');
        Route::patch('/trash/customers/restore/{page_id}/{id_customer}', [CostumersController::class, 'restore'])->name('customers.restore');
//      Shipments
        Route::patch('/shipments/{page_id}/{id_ship}', [ShipmentsController::class, 'update'])->name('shipments.update');
        Route::patch('/trash/shipments/restore/{page_id}/{id_ship}', [ShipmentsController::class, 'restore'])->name('shipments.restore');
        Route::patch('/shipments/status/update/{page_id}/{id_status_ship}', [StatusShipmentsController::class, 'update'])->name('status.shipments.update');
//      SubCities
        Route::patch('/subCities/{page_id}/{id_city}', [SubCitiesController::class, 'update'])->name('subCities.update');
        Route::patch('/trash/subCities/{page_id}/{id_city}', [SubCitiesController::class, 'restore'])->name('subCities.restore');
//      Status
        Route::patch('/status/{page_id}/{id_status}', [TypeStatusController::class, 'update'])->name('status.update');
//      Roles
        Route::patch('/roles/update/{page_id}/{id_role}', [RolesController::class, 'update'])->name('roles.update');
        Route::patch('/trash/roles/update/{page_id}/{id_role}', [RolesController::class, 'restore'])->name('roles.restore');
        Route::patch('/roles/material/edit/{page_id}/{id_role}', [MaterialRolesController::class, 'edit'])->name('materialRoles.edit');
    });

    Route::middleware('CheckDeletePermission')->group(function () {
//      Branches
        Route::delete('/branches/delete/{page_id}/{id_branch}', [BranchesController::class, 'destroy'])->name('branches.destroy');
        Route::delete('/trash/branches/delete/{page_id}/{id_branch}', [BranchesController::class, 'delete'])->name('branches.delete');
//      Employees
        Route::delete('/employees/{page_id}/{id_emp}', [EmployeesController::class, 'destroy'])->name('employees.destroy');
        Route::delete('/trash/employees/delete/{page_id}/{id_emp}', [EmployeesController::class, 'delete'])->name('employees.delete');
//      Delegates
        Route::delete('/delegates/delete/{page_id}/{id_delegate}', [DelegatesController::class, 'destroy'])->name('delegates.destroy');
        Route::delete('/trash/delegates/delete/{page_id}/{id_delegate}', [DelegatesController::class, 'delete'])->name('delegates.delete');
//      Customers
        Route::delete('/customers/{page_id}/{id_customer}', [CostumersController::class, 'destroy'])->name('customers.destroy');
        Route::delete('/trash/customers/{page_id}/{id_customer}', [CostumersController::class, 'delete'])->name('customers.delete');
//      Shipments
        Route::delete('/shipments/{page_id}/{id_ship}', [ShipmentsController::class, 'destroy'])->name('shipments.destroy');
        Route::delete('/trash/shipments/{page_id}/{id_ship}', [ShipmentsController::class, 'delete'])->name('shipments.delete');
//      SubCities
        Route::delete('/subCities/{page_id}/{id_city}', [SubCitiesController::class, 'destroy'])->name('subCities.destroy');
        Route::delete('/trash/subCities/{page_id}/{id_city}', [SubCitiesController::class, 'delete'])->name('subCities.delete');
//      Status
        Route::delete('/status/{page_id}/{id_status}', [TypeStatusController::class, 'destroy'])->name('status.destroy');
//      Roles
        Route::delete('/roles/destroy/{page_id}/{id_role}', [RolesController::class, 'destroy'])->name('roles.destroy');
        Route::delete('/trash/roles/destroy/{page_id}/{id_role}', [RolesController::class, 'delete'])->name('roles.delete');

    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
