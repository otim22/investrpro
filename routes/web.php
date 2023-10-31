<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberSavingsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MemberRegistrationController;

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

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::name('admin.')
    ->prefix('admin')
    ->middleware(['web', 'auth', 'role:admin|super-admin'])
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
});

Route::resource('users', UsersController::class);
Route::resource('member-registration', MemberRegistrationController::class);

Route::resource('/member-savings', MemberSavingsController::class);
Route::resource('/economic-calendar-year', MemberSavingsController::class);
Route::get('/membership-fee', [App\Http\Controllers\MembershipFeeController::class, 'index'])->name('membership-fee');
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
