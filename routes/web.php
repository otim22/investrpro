<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AllMembersController;
use App\Http\Controllers\ExecutiveMembersController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NextOfKinController;
use App\Http\Controllers\MemberSavingsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::get('/all-members', [AllMembersController::class, 'index'])->name('all-members');
    Route::get('/executive-members', [ExecutiveMembersController::class, 'index'])->name('executive-members');
    Route::resource('/members', MemberController::class);

    Route::get('/members/{member}/next-of-kins', [NextOfKinController::class, 'create'])->name('next-of-kin.create');
    Route::get('/members/{member}/next-of-kins/{nextOfKin}', [NextOfKinController::class, 'show'])->name('next-of-kin.show');
    Route::get('/members/{member}/next-of-kins', [NextOfKinController::class, 'index'])->name('next-of-kin.index');
    Route::post('/members/{member}/next-of-kins', [NextOfKinController::class, 'store'])->name('next-of-kin.store');
    Route::get('/members/{member}/next-of-kins/{nextOfKin}/edit', [NextOfKinController::class, 'edit'])->name('next-of-kin.edit');
    Route::patch('/members/{member}/next-of-kins/{nextOfKin}/update', [NextOfKinController::class, 'update'])->name('next-of-kin.update');
    Route::delete('/members/{member}/next-of-kins/{nextOfKin}/destroy', [NextOfKinController::class, 'destroy'])->name('next-of-kin.delete');

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
});

// Admin
Route::name('admin.')
    ->prefix('admin')
    ->middleware(['web', 'auth', 'role:super-admin'])
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/roles', RoleController::class);
        Route::resource('/permissions', PermissionController::class);
});