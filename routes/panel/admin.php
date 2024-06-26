<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\InsurerEmailsManagementController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExportToExcelController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\Quote\Car\CarQuoteController;
use App\Http\Controllers\QuoteCloserController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\QuoteConvertController;
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

# Routes for AUTH
#-------------------------------------------------------------

// Route::get('/', function () {
//     return redirect(route('login'));
// });


# Routes for ADMIN
#-------------------------------------------------------------

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    # Dashboard Route
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');


    # Admin Employees Routes
    Route::get('/employee-list', [EmployeeController::class, 'index'])->name('admin.employeeList');
    Route::get('/json', [EmployeeController::class, 'tableJson'])->name('employeeJson');

    Route::get('/create-employee', [EmployeeController::class, 'createEmployee'])->name('admin.createEmployee');
    Route::post('/store-employee', [EmployeeController::class, 'storeEmployee'])->name('admin.storeEmployee');


    Route::post('/import-content', [ExportToExcelController::class, 'importContent'])->name('importContents');
    Route::get('/import-view', [ExportToExcelController::class, 'importView'])->name('importView');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroyCustomre'])->name('customer.destroy');
    Route::get('/insurer-emails-management', [InsurerEmailsManagementController::class, 'showForm'])->name('admin.insurer-emails-management-show');
    Route::get('/add-riskoccupancy', [SettingsController::class, 'addRiskOccupancy'])->name('admin.add-riskoccupancy');
    Route::post('/import-riskoccupancy', [SettingsController::class, 'storeRiskOccupancy'])->name('admin.store-riskoccupancy');


    #  Insurers and Emails Management Routes
    Route::get('/manage-insurers', [SettingsController::class, 'manageInsurersAndEmails'])->name('admin.manageInsurersAndEmails');
    Route::post('/add-insurers', [SettingsController::class, 'storeInsurers'])->name('admin.storeInsurers');
    Route::post('/add-emails', [SettingsController::class, 'storeEmails'])->name('admin.storeEmails');

    Route::post('/add-productSections', [SettingsController::class, 'storeProductSections'])->name('admin.storeProductSections');


    # Product And Category Management Routes
    Route::get('/manage-products', [SettingsController::class, 'manageProducts'])->name('admin.manageProducts');
    Route::post('/store-category', [SettingsController::class, 'storeCategory'])->name('admin.storeCategory');
    Route::post('/delete-category', [SettingsController::class, 'destroyCategory'])->name('admin.destroyCategory');
    Route::post('/store-products', [SettingsController::class, 'storeProducts'])->name('admin.storeProducts');
    Route::post('/delete-products', [SettingsController::class, 'destroyCategory'])->name('admin.destroyProducts');
});


