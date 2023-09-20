<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExportToExcelController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\QuoteCloserController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\QuoteConvertController;
use App\Http\Livewire\Customer\CustomerList;
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
// nnsadmin routes

// Route::get('/', function () {
//     return view('home');
// });

// Route::get('/', [CustomerController::class, 'index'])->name('customer.table');
Route::get('/', [AuthController::class, 'loginUsers']);
Route::middleware('adminOrEmployee')->group(function () {

    Route::view('/customer', 'customer')->name('target.route.name');
    Route::get('/quote', [CustomerController::class, 'quote']);
    Route::view('/insurer', 'insurer');
    Route::get('/customers', [CustomerController::class, 'index'])->name('customer.table');

    Route::get('/search-items', [CustomerController::class, 'search'])->name('search.items');



    Route::post('/customers', [CustomerController::class, 'store']);

    Route::get('/search-customers', [CustomerController::class, 'searchCustomers']);

    Route::get('/view/{id}', [CustomerController::class, 'getCustomers'])->name('customer.view');

    Route::delete('/customers/{id}', [CustomerController::class, 'destroyCustomre'])->name('customer.destroy');

    Route::get('/customers/{id}/edit', [CustomerController::class, 'editCustomer'])->name('customer.edit');
    Route::put('/customers/{id}', [CustomerController::class, 'updateCustomer'])->name('customer.update');

    Route::post('/quote', [CustomerController::class, 'quoteStore'])->name('quote.generate');
    Route::get('/quote-edit/{id}', [CustomerController::class, 'quoteEdit'])->name('quote.edit');


    Route::get('/quote_view/{id}', [CustomerController::class, 'quoteView'])->name('quote.view');


    Route::get('/generate-pdf/{id}', [PdfController::class, 'generatePDF'])->name('download-pdf');

    Route::get('/quote_list', [CustomerController::class, 'quoteList'])->name('quoteList');

    Route::get('/export-customer/{id}', [ExportToExcelController::class, 'exportToExcel'])->name('exportCustomer');
    Route::post('/import-content', [ExportToExcelController::class, 'importContent'])->name('importContents');

    Route::get('/import-view', [ExportToExcelController::class, 'importView'])->name('importView');


    Route::get('/create-notification-form/{id}', [NotificationController::class, 'createNotificationForm'])->name('notificationForm');
    Route::post('/send-attachment-email', [NotificationController::class, 'sendNotification'])->name('send-attachment-email');
    Route::get('/get-emails', [NotificationController::class, 'getEmails'])->name('get-emails');



    // TEST ROUTING

    Route::view('/test-add-quote', 'quote.quoteFire.quoteFire');
    Route::get('/login', [AuthController::class, 'loginUsers'])->name('login');

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
    Route::post('/closer-quote', [QuoteCloserController::class, 'policyStore'])->name('closer-quote-post');;
});
