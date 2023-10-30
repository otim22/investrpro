<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/member-savings', [App\Http\Controllers\MemberSavingsController::class, 'index'])->name('member-savings');
Route::get('/expenses', [App\Http\Controllers\ExpensesController::class, 'index'])->name('expenses');
Route::get('/charges', [App\Http\Controllers\ChargesController::class, 'index'])->name('charges');
Route::get('/investments', [App\Http\Controllers\InvestmentsController::class, 'index'])->name('investments');
Route::get('/general-report', [App\Http\Controllers\GeneralReportController::class, 'index'])->name('general-report');
Route::get('/financial-report', [App\Http\Controllers\FinancialReportController::class, 'index'])->name('financial-report');
Route::get('/audit-report', [App\Http\Controllers\AuditReportController::class, 'index'])->name('audit-report');
Route::get('/sop', [App\Http\Controllers\SOPController::class, 'index'])->name('sop');
Route::get('/constitution', [App\Http\Controllers\ConstitutionController::class, 'index'])->name('constitution');
Route::get('/saved-emails', [App\Http\Controllers\SavedEmailsController::class, 'index'])->name('saved-emails');
Route::get('/recordings', [App\Http\Controllers\RecordingsController::class, 'index'])->name('recordings');
Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('account');
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::get('/billing', [App\Http\Controllers\BillingController::class, 'index'])->name('billing');
