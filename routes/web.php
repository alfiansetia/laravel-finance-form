<?php

use App\Http\Controllers\DebitNoteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentRequestController;
use App\Http\Controllers\WhtController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
    'confirm' => false
]);

Route::get('/', function () {
    return redirect()->route('payment.index');
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('wht', WhtController::class);
    Route::resource('payment', PaymentRequestController::class);
    Route::get('payment/{payment}/download', [PaymentRequestController::class, 'download'])->name('payment.download');

    Route::resource('debit', DebitNoteController::class);
});
