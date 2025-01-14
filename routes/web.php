<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AllMembersController;
use App\Http\Controllers\ExecutiveMembersController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NextOfKinController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrgUserController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\ProcedureController;
use App\Http\Controllers\LoanApplicationController;
use App\Http\Controllers\LoanApprovalController;
use App\Http\Controllers\LoanHistoryController;
use App\Http\Controllers\ManageLoanController;
use App\Http\Controllers\LiabilityController;
use App\Http\Controllers\ProfitAndLossController;
use App\Http\Controllers\AuditReportController;
use App\Http\Controllers\FinancialReportController;
use App\Http\Controllers\GeneralReportController;
use App\Http\Controllers\HrManualController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\IndividualAccountController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AssetTypeController;
use App\Http\Controllers\Admin\ExpenseTypeController;
use App\Http\Controllers\Admin\ChargeSettingController;
use App\Http\Controllers\Admin\FinancialMonthController;
use App\Http\Controllers\Admin\FinancialYearController;
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
    Route::get('/individual-account', [IndividualAccountController::class, 'index'])->name('individual-account');
    Route::get('/all-members', [AllMembersController::class, 'index'])->name('all-members');
    Route::get('/executive-members', [ExecutiveMembersController::class, 'index'])->name('executive-members');
    Route::resource('/members', MemberController::class);
    Route::get('/members/{member}/nextOfKins/create', [NextOfKinController::class, 'create'])->name('next-of-kin.create');
    Route::get('/members/{member}/next-of-kins/{nextOfKin}/show', [NextOfKinController::class, 'show'])->name('next-of-kin.show');
    Route::get('/members/{member}/next-of-kins/index', [NextOfKinController::class, 'index'])->name('next-of-kin.index');
    Route::post('/members/{member}/next-of-kins/store', [NextOfKinController::class, 'store'])->name('next-of-kin.store');
    Route::get('/members/{member}/next-of-kins/{nextOfKin}/edit', [NextOfKinController::class, 'edit'])->name('next-of-kin.edit');
    Route::patch('/members/{member}/next-of-kins/{nextOfKin}/update', [NextOfKinController::class, 'update'])->name('next-of-kin.update');
    Route::delete('/members/{member}/next-of-kins/{nextOfKin}/destroy', [NextOfKinController::class, 'destroy'])->name('next-of-kin.delete');
    Route::resource('/expenses', ExpenseController::class);
    Route::resource('/assets', AssetController::class);
    Route::resource('/procedures', ProcedureController::class);
    Route::get('/procedures/download/{id}', [ProcedureController::class, 'download'])->name('procedures.download');
    Route::resource('/loan-application', LoanApplicationController::class);
    Route::get('/loan-approval', [LoanApprovalController::class, 'index'])->name('loan-approval.index');
    Route::get('/loan-approval/{loanApplication}/show', [LoanApprovalController::class, 'show'])->name('loan-approval.show');
    Route::get('/loan-history', [LoanHistoryController::class, 'index'])->name('loan-history');
    Route::get('/settlements', [ManageLoanController::class, 'index'])->name('settlements.index');
    Route::get('/settlements/{settlement}/show', [ManageLoanController::class, 'show'])->name('settlements.show');
    Route::get('/settlements/{settlement}/edit', [ManageLoanController::class, 'edit'])->name('settlements.edit');
    Route::patch('/settlements/{settlement}/update', [ManageLoanController::class, 'update'])->name('settlements.update');
    Route::resource('/meetings', MeetingController::class);
    Route::get('/meetings/{meeting}/attendances/create', [AttendanceController::class, 'create'])->name('attendances.create');
    Route::get('/meetings/{meeting}/attendances/{attendance}/show', [AttendanceController::class, 'show'])->name('attendances.show');
    Route::get('/meetings/{meeting}/attendances/index', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::post('/meetings/{meeting}/attendances/store', [AttendanceController::class, 'store'])->name('attendances.store');
    Route::get('/meetings/{meeting}/attendances/{attendance}/edit', [AttendanceController::class, 'edit'])->name('attendances.edit');
    Route::patch('/meetings/{meeting}/attendances/{attendance}/update', [AttendanceController::class, 'update'])->name('attendances.update');
    Route::delete('/meetings/{meeting}/attendances/{attendance}/destroy', [AttendanceController::class, 'destroy'])->name('attendances.destroy');
    Route::resource('/charges', ChargeController::class);
    Route::get('/calendar/index', [CalendarController::class, 'index'])->name('calendar.index');
    Route::post('/calendar', [CalendarController::class, 'store'])->name('calendar.store');
    Route::patch('/calendar/update/{id}', [CalendarController::class, 'update'])->name('calendar.update');
    Route::delete('/calendar/destroy/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');
    Route::resource('/investments', InvestmentController::class);
    Route::get('/liabilities', [LiabilityController::class, 'index'])->name('liabilities.index');
    Route::get('/profit-and-loss', [ProfitAndLossController::class, 'index'])->name('profit-and-loss.index');
    Route::resource('/general-reports', GeneralReportController::class);
    Route::get('/general-reports/download/{id}', [GeneralReportController::class, 'download'])->name('general-reports.download');
    Route::resource('/financial-reports', FinancialReportController::class);
    Route::get('/financial-reports/download/{id}', [FinancialReportController::class, 'download'])->name('financial-reports.download');
    Route::resource('/audit-reports', AuditReportController::class);
    Route::get('/audit-reports/download/{id}', [AuditReportController::class, 'download'])->name('audit-reports.download');
    Route::resource('/hr-manuals', HrManualController::class);
    Route::get('/hr-manuals/download/{id}', [HrManualController::class, 'download'])->name('hr-manuals.download');
    Route::get('/billing', [App\Http\Controllers\BillingController::class, 'index'])->name('billing');

    //  User management
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/home', [UserController::class, 'uploadProfilePic'])->name('upload.profile');
    Route::patch('/update-name', [UserController::class, 'updateName'])->name('update.name');
    Route::patch('/update-password', [UserController::class, 'updatePassword'])->name('update.password');
    Route::get('/add-user', [OrgUserController::class, 'index'])->name('org.user.index');
    Route::get('/add-user/create', [OrgUserController::class, 'create'])->name('org.user.create');
    Route::post('/add-user/store', [OrgUserController::class, 'store'])->name('org.user.store');
    Route::get('/add-user/{user}/show', [OrgUserController::class, 'show'])->name('org.user.show');
    Route::get('/add-user/{user}/edit', [OrgUserController::class, 'edit'])->name('org.user.edit');
    Route::patch('/add-user/{user}/update', [OrgUserController::class, 'update'])->name('org.user.update');
    Route::delete('/add-user/{user}/delete', [OrgUserController::class, 'destroy'])->name('org.user.destroy');
});

// Admin
Route::name('admin.')
    ->prefix('admin')
    ->middleware(['web', 'auth', 'role:super-admin'])
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/financial-months', FinancialMonthController::class);
        Route::resource('/financial-years', FinancialYearController::class);
        Route::resource('/charge-settings', ChargeSettingController::class);
        Route::resource('/asset-types', AssetTypeController::class);
        Route::resource('/expense-types', ExpenseTypeController::class);
        Route::resource('/roles', RoleController::class);
        Route::resource('/permissions', PermissionController::class);
});