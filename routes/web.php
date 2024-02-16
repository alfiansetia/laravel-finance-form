<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\DebitNoteController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\FilednController;
use App\Http\Controllers\FileprController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentRequestController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValidatorController;
use App\Http\Controllers\VatController;
use App\Http\Controllers\VendorController;
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
    'reset' => true,
    'verify' => false,
    'confirm' => false
]);

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('wht', WhtController::class);

    Route::resource('bank', BankController::class);

    Route::resource('division', DivisionController::class);

    Route::resource('vendor', VendorController::class);

    Route::resource('validator', ValidatorController::class);

    Route::resource('vat', VatController::class);

    Route::resource('payment', PaymentRequestController::class);
    Route::get('payment/{payment}/download', [PaymentRequestController::class, 'download'])->name('payment.download');
    Route::post('payment/{payment}/status', [PaymentRequestController::class, 'status'])->name('payment.status');
    Route::post('payment/{payment}/paid', [PaymentRequestController::class, 'paid'])->name('payment.set.paid');

    Route::resource('debit', DebitNoteController::class);
    Route::get('debit/{debit}/download', [DebitNoteController::class, 'download'])->name('debit.download');
    Route::post('debit/{debit}/status', [DebitNoteController::class, 'status'])->name('debit.status');

    Route::resource('user', UserController::class)->except(['show']);
    Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('user/profile', [UserController::class, 'profileUpdate'])->name('user.profile.update');
    Route::post('user/password', [UserController::class, 'passwordUpdate'])->name('user.password.update');

    Route::get('report/payment', [ReportController::class, 'payment'])->name('report.payment.index');
    Route::get('report/debit', [ReportController::class, 'debit'])->name('report.debit.index');

    Route::post('filepr', [FileprController::class, 'store'])->name('filepr.store');
    Route::get('filepr/{filepr}', [FileprController::class, 'show'])->name('filepr.show');
    Route::delete('filepr/{filepr}', [FileprController::class, 'destroy'])->name('filepr.destroy');

    Route::post('filedn', [FilednController::class, 'store'])->name('filedn.store');
    Route::get('filedn/{filedn}', [FilednController::class, 'show'])->name('filedn.show');
    Route::delete('filedn/{filedn}', [FilednController::class, 'destroy'])->name('filedn.destroy');
});
