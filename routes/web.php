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

Route::get('/tes', function () {
    return view('tes');
});

Route::get('/tes2', function () {
    return view('tes2');
});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
// PAYMENT REQUEST
Route::get('/', [PaymentRequestController::class, 'index'])->name('payment_request');
Route::get('/add-payment-request', [PaymentRequestController::class, 'create'])->name('add_payment_request');
Route::get('/edit-payment-request/{id}', [PaymentRequestController::class, 'edit'])->name('edit_payment_request');
Route::post('/update-payment-request', [PaymentRequestController::class, 'update'])->name('update_payment_request');
Route::post('/store-payment-request', [PaymentRequestController::class, 'store'])->name('store_payment_request');
Route::delete('/delete-payment-request/{id}', [PaymentRequestController::class, 'delete'])->name('delete_payment_request');
Route::get('/print-payment-request/{id}', [PaymentRequestController::class, 'print'])->name('print_payment_request');

// DEBIT NOTE
Route::get('/debit_note', [DebitNoteController::class, 'index'])->name('debit_note');
Route::get('/add-debit-note', [DebitNoteController::class, 'create'])->name('add_debit_note');
Route::post('/store-debit-note', [DebitNoteController::class, 'store'])->name('store_debit_note');
Route::delete('/delete-debit-note/{id}', [DebitNoteController::class, 'delete'])->name('delete_debit_note');
Route::get('/edit-debit-note/{id}', [DebitNoteController::class, 'edit'])->name('edit_debit_note');
Route::post('/update-debit-note', [DebitNoteController::class, 'update'])->name('update_debit_note');
Route::get('/print-debit-note/{id}', [DebitNoteController::class, 'print'])->name('print_debit_note');

Route::resource('wht', WhtController::class);

Route::get('/logout-action',   function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout-action');
