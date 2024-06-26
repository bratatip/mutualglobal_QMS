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


Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/dologin', [AuthController::class, 'doLogin'])->name('doLogin');
Route::middleware(['auth'])->get('/logout', [AuthController::class, 'logOut'])->name('logOut');

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


# Routes For EMPLOYEE
#-------------------------------------------------------------

# Routes For ADMIN && EMPLOYEE 
#-------------------------------------------------------------
Route::middleware(['auth', 'role:employee,admin'])->group(function () {
});




# Routes For CLIENT
#-------------------------------------------------------------



Route::middleware(['auth', 'role:employee,admin'])->group(function () {

    Route::get('/quote/{uuid}', [CustomerController::class, 'quote'])->name('fire.quoteGenerate');

    Route::get('/customer', [CustomerController::class, 'addCustomerForm'])->name('customer.add');
    Route::get('/customers-list', [CustomerController::class, 'index'])->name('customer.index');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customers/{id}/edit', [CustomerController::class, 'editCustomer'])->name('customer.edit');
    Route::put('/customers/{id}', [CustomerController::class, 'updateCustomer'])->name('customer.update');


    Route::get('/search-items', [CustomerController::class, 'search'])->name('search.items');

    Route::get('/view/{id}', [CustomerController::class, 'getCustomers'])->name('customer.view');

    // search for autopopulate customers
    Route::get('/search-customers', [CustomerController::class, 'searchCustomers']);

    // search for autopopulate on renew customer
    Route::get('/search-quote', [CustomerController::class, 'quoteAutopopulateOnRenew'])->name('search.quoteAutopopulate');

    Route::get('/quote', [CustomerController::class, 'quoteStore'])->name('quote.generate');
    Route::get('/quote-edit/{id}', [CustomerController::class, 'quoteEdit'])->name('quote.edit');


    Route::get('/quote_view/{id}', [CustomerController::class, 'quoteView'])->name('quote.view');


    Route::get('/generate-pdf/{id}', [PdfController::class, 'generatePDF'])->name('download-pdf');

    Route::get('/quote_list', [CustomerController::class, 'quoteList'])->name('quoteList');

    Route::get('/export-customer/{id}', [ExportToExcelController::class, 'exportToExcel'])->name('exportCustomer');

    Route::get('/create-notification-form/{id}', [NotificationController::class, 'createNotificationForm'])->name('notificationForm');
    Route::post('/send-attachment-email', [NotificationController::class, 'sendNotification'])->name('send-attachment-email');
    Route::get('/get-emails', [NotificationController::class, 'getEmails'])->name('get-emails');


    Route::get('/final-quote/{id}', [QuoteController::class, 'finalizeQuoteGet'])->name('finalize-quote');
    Route::post('/final-quote', [QuoteController::class, 'finalizeQuote'])->name('quote-finalize');


    // Quote Converted

    Route::post('/convert-quote', [QuoteConvertController::class, 'quoteConvert'])->name('quote-convert');
    Route::get('/convert-quote/{id}', [QuoteController::class, 'convertQuoteGet'])->name('convert-quote');
    Route::get('/emails/{id}', [NotificationController::class, 'emailToInsurerClient'])->name('email');
    Route::post('/emails', [NotificationController::class, 'emailToInsurerClientSend'])->name('email-send');
    Route::get('/email-to-customer/{id}', [NotificationController::class, 'emailToCustomer'])->name('email-to-customer');
    Route::post('/email-to-customer', [NotificationController::class, 'emailToCustomerSend'])->name('email-send-to-customer');

    // Quote clouser

    Route::get('/closer-quote/{id}', [QuoteCloserController::class, 'quoteGet'])->name('closer-quote');;
    Route::post('/closer-quote', [QuoteCloserController::class, 'policyStore'])->name('closer-quote-post');


    # Routes for FIRE PRODUCTS
    

    # Routes for ENGINEERING PRODUCTS
    # -------------------------------- CAR ROUTES --------------------------------------------------
    Route::get('/car-quoteForm/{uuid}', [CarQuoteController::class, 'formView'])->name('car.quoteGenerate');
    Route::post('/car-quoteStore', [CarQuoteController::class, 'quoteStore'])->name('car.quoteStore');

    # -------------------------------- EAR ROUTS--------------------------------------------------
    // Route::get('/ear-quoteGenerate',[CarQuoteController::class, 'formView'])->name('ear.quoteGenerate');


    # -------------------------------- CPM ROUTS--------------------------------------------------
    // Route::get('/cpm-quoteGenerate',[CarQuoteController::class, 'formView'])->name('cpm.quoteGenerate');

});
