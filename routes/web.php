<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NominationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\WhatsAppController;

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

// Middleware for authenticated users
Route::middleware(['auth'])->group(function () {
    // This ensures that the user cannot access /form without completing their profile first
    Route::middleware(['check.user.info'])->group(function () {
        Route::resource('/form', NominationController::class); // Only allows access if data is valid
    });
    Route::resource('/info', InfoController::class);
    // Route::get('/user-ban/{id}', [InfoController::class, 'banUser'])->name('user.ban');

});

// Middleware for unauthenticated users
Route::middleware(['redirectIfAuthenticated'])->group(function () {
    // This will ensure that logged-in users cannot access the /signin-signup routes
    Route::resource('/signin-signup', CaseController::class);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
});

Route::get('/whatsapp/{phone?}/{name?}', [WhatsAppController::class, 'sendMessage'])->name('whatsapp.message');

Route::post('/user/ban/{id}', [InfoController::class, 'toggleBan'])->name('user.toggle.ban');
Route::post('/user/reset/{id}', [InfoController::class, 'resetIsUpdated'])->name('user.reset.isupdated');
Route::post('/user/submit/reset/{id}', [InfoController::class, 'resetIsSubmitted'])->name('user.reset.issubmitted');


// If user's information is incomplete, redirect them to /info
Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);
Route::resource('/theme', ThemeController::class);
Route::get('/', [NominationController::class, 'redirect'])->name('form.redirect');
Route::get('/form/hosted/{ukey?}', [NominationController::class, 'hosted'])->name('form.hosted');
Route::post('/form/updateinfo/{id}', [NominationController::class, 'updateinfo'])->name('form.updateinfo');
Route::get('/thank-you/{ukey?}', [NominationController::class, 'thanks'])->name('form.thank');
Route::get('/thanks/{ukey?}', [NominationController::class, 'free'])->name('form.thank.free');
Route::get('/block-user', [DashboardController::class, 'blockUser'])->name('block.user');
Route::resource('/dashboard', DashboardController::class);
Route::post('/dashboard/payment', [DashboardController::class, 'makePayment'])->name('dashboard.payment');
Route::post('/dashboard/payment/confirm', [DashboardController::class, 'paymentConfirmation'])->name('dashboard.payment.confirm');
Route::get('/trash', [DashboardController::class, 'trash'])->name('trash.index');
Route::get('/payment-verified', [DashboardController::class, 'pv'])->name('paymentverified.index');
Route::get('/status-update/{id}', [DashboardController::class, 'updateStatus'])->name('status.update');
Route::get('/payment-status-update/{id}', [DashboardController::class, 'updatePV'])->name('payment.status.update');
Route::get('/trash-update/{id}', [DashboardController::class, 'updateTrash'])->name('trash.update');
Route::get('/comment-empty/{id}', [DashboardController::class, 'commentEmpty'])->name('comment.empty');
Route::resource('/invoice', InvoiceController::class);
Route::get('/invoice-form', [InvoiceController::class, 'form'])->name('invoice.form');
Route::get('/logout', [ThemeController::class, 'logout'])->name('logout');
Route::post('/authenticate-theme', [ThemeController::class, 'authenticateTheme'])->name('authenticate.theme');
Route::post('/authenticate-dashboard', [ThemeController::class, 'authenticateDashboard'])->name('authenticate.dashboard');
Route::post('/authenticate-time', [ThemeController::class, 'authenticateTime'])->name('authenticate.time');
Route::get('/time', [ThemeController::class, 'time'])->name('theme.time');

// SSLCOMMERZ Start
Route::get('/easycheckout', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/hostedcheckout', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

Route::get('/nomination-export', [NominationController::class, 'allExport'])->name('all.export');


Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('logout/', [LoginController::class, 'handleLogout'])->name('google.logout');
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);
