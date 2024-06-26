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