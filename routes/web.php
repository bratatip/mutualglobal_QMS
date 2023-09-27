<?php

use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\InsurerEmailsManagementController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExportToExcelController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PdfController;
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

Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/dologin', [LoginController::class, 'doLogin'])->name('doLogin');


Route::middleware('adminOrEmployee')->group(function () {

    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::post('/import-content', [ExportToExcelController::class, 'importContent'])->name('importContents');
        Route::get('/import-view', [ExportToExcelController::class, 'importView'])->name('importView');
        Route::delete('/customers/{id}', [CustomerController::class, 'destroyCustomre'])->name('customer.destroy');
        Route::get('/insurer-emails-management',[InsurerEmailsManagementController::class,'showForm'])->name('admin.insurer-emails-management-show');
        Route::get('/add-riskoccupancy',[SettingsController::class,'addRiskOccupancy'])->name('admin.add-riskoccupancy');
        Route::post('/import-riskoccupancy',[SettingsController::class,'storeRiskOccupancy'])->name('admin.store-riskoccupancy');
        
        # Admin Employees Routes
        Route::get('/create-employee',[EmployeeController::class, 'createEmployee'])->name('admin.createEmployee');
        Route::post('/store-employee',[EmployeeController::class, 'storeEmployee'])->name('admin.storeEmployee');
        
        # Product And Category Management Routes
        Route::get('/manage-products',[SettingsController::class, 'manageProducts'])->name('admin.manageProducts');
        Route::post('/store-category',[SettingsController::class, 'storeCategory'])->name('admin.storeCategory');
        Route::post('/delete-category',[SettingsController::class, 'destroyCategory'])->name('admin.destroyCategory');
        Route::post('/store-products',[SettingsController::class, 'storeProducts'])->name('admin.storeProducts');
        Route::post('/delete-products',[SettingsController::class, 'destroyCategory'])->name('admin.destroyProducts');


        #  Insurers and Emails Management Routes
        Route::get('/manage-insurers',[SettingsController::class,'manageInsurersAndEmails'])->name('admin.manageInsurersAndEmails');
        Route::post('/add-insurers',[SettingsController::class,'storeInsurers'])->name('admin.storeInsurers');
        Route::post('/add-emails',[SettingsController::class,'storeEmails'])->name('admin.storeEmails');

        Route::post('/add-productSections',[SettingsController::class,'storeProductSections'])->name('admin.storeProductSections');

    });


    Route::get('/logout',[LoginController::class, 'logOut'])->name('logOut');

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

    Route::post('/quote', [CustomerController::class, 'quoteStore'])->name('quote.generate');
    Route::get('/quote-edit/{id}', [CustomerController::class, 'quoteEdit'])->name('quote.edit');


    Route::get('/quote_view/{id}', [CustomerController::class, 'quoteView'])->name('quote.view');


    Route::get('/generate-pdf/{id}', [PdfController::class, 'generatePDF'])->name('download-pdf');

    Route::get('/quote_list', [CustomerController::class, 'quoteList'])->name('quoteList');

    Route::get('/export-customer/{id}', [ExportToExcelController::class, 'exportToExcel'])->name('exportCustomer');
   
    Route::get('/create-notification-form/{id}', [NotificationController::class, 'createNotificationForm'])->name('notificationForm');
    Route::post('/send-attachment-email', [NotificationController::class, 'sendNotification'])->name('send-attachment-email');
    Route::get('/get-emails', [NotificationController::class, 'getEmails'])->name('get-emails');

    # Routes for CAR PRODUCTS
    Route::view('/car-quoteGenerate','quoteFire')->name('car.quoteGenerate');

    // TEST ROUTING

    Route::view('/test-add-quote', 'quote.quoteFire.quoteFire');

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


    
});
