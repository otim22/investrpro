<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AllMembersController;
use App\Http\Controllers\ExecutiveMembersController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\FinancialMonthController;
use App\Http\Controllers\FinancialYearController;
use App\Http\Controllers\NextOfKinController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrgUserController;
use App\Http\Controllers\MemberSavingController;
use App\Http\Controllers\MembershipFeeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\LateRemissionController;
use App\Http\Controllers\MissedMeetingController;
use App\Http\Controllers\ChargeSettingController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetTypeController;
use App\Http\Controllers\LiabilityController;
use App\Http\Controllers\LiabilityTypeController;
use App\Http\Controllers\AuditReportController;
use App\Http\Controllers\FinancialReportController;
use App\Http\Controllers\GeneralReportController;
use App\Http\Controllers\ConstitutionController;
use App\Http\Controllers\SopController;
use App\Http\Controllers\MeetingMinuteController;
use App\Http\Controllers\SavedEmailController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CalendarController;
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
    Route::get('/members/{member}/nextOfKins/create', [NextOfKinController::class, 'create'])->name('next-of-kin.create');
    Route::get('/members/{member}/next-of-kins/{nextOfKin}/show', [NextOfKinController::class, 'show'])->name('next-of-kin.show');
    Route::get('/members/{member}/next-of-kins/index', [NextOfKinController::class, 'index'])->name('next-of-kin.index');
    Route::post('/members/{member}/next-of-kins/store', [NextOfKinController::class, 'store'])->name('next-of-kin.store');
    Route::get('/members/{member}/next-of-kins/{nextOfKin}/edit', [NextOfKinController::class, 'edit'])->name('next-of-kin.edit');
    Route::patch('/members/{member}/next-of-kins/{nextOfKin}/update', [NextOfKinController::class, 'update'])->name('next-of-kin.update');
    Route::delete('/members/{member}/next-of-kins/{nextOfKin}/destroy', [NextOfKinController::class, 'destroy'])->name('next-of-kin.delete');
    Route::resource('/membership-fees', MembershipFeeController::class);
    Route::resource('/expenses', ExpenseController::class);
    Route::resource('/member-savings', MemberSavingController::class);
    Route::resource('/late-remissions', LateRemissionController::class);
    Route::resource('/missed-meetings', MissedMeetingController::class);
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::resource('/investments', InvestmentController::class);
    Route::get('/assets', [AssetController::class, 'index'])->name('assets.index');

    Route::get('late-remissions-by-month', [AssetController::class, 'filterData']);

    Route::get('/liabilities', [LiabilityController::class, 'index'])->name('liabilities.index');
    Route::resource('/general-reports', GeneralReportController::class);
    Route::get('/general-reports/download/{id}', [GeneralReportController::class, 'download'])->name('general-reports.download');
    Route::resource('/financial-reports', FinancialReportController::class);
    Route::get('/financial-reports/download/{id}', [FinancialReportController::class, 'download'])->name('financial-reports.download');
    Route::resource('/audit-reports', AuditReportController::class);
    Route::get('/audit-reports/download/{id}', [AuditReportController::class, 'download'])->name('audit-reports.download');
    Route::resource('/constitution', ConstitutionController::class);
    Route::get('/constitution/download/{id}', [ConstitutionController::class, 'download'])->name('constitution.download');
    Route::resource('/sop', SopController::class);
    Route::get('/sop/download/{id}', [SopController::class, 'download'])->name('sop.download');
    Route::resource('/meeting-minutes', MeetingMinuteController::class);
    Route::get('/meeting-minutes/download/{id}', [MeetingMinuteController::class, 'download'])->name('meeting-minutes.download');
    Route::resource('/saved-emails', SavedEmailController::class);
    Route::get('/saved-emails/download/{id}', [SavedEmailController::class, 'download'])->name('saved-emails.download');
    Route::resource('/elections', ElectionController::class);
    Route::get('/elections/download/{id}', [ElectionController::class, 'download'])->name('elections.download');
    Route::get('/meeting-recordings', [App\Http\Controllers\MeetingRecordingController::class, 'index'])->name('recordings');
    Route::get('/billing', [App\Http\Controllers\BillingController::class, 'index'])->name('billing');

    //  User management
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::patch('/update-name', [UserController::class, 'updateName'])->name('update.name');
    Route::patch('/update-password', [UserController::class, 'updatePassword'])->name('update.password');
    Route::get('/add-user', [OrgUserController::class, 'index'])->name('org.user.index');
    Route::get('/add-user/create', [OrgUserController::class, 'create'])->name('org.user.create');
    Route::post('/add-user/store', [OrgUserController::class, 'store'])->name('org.user.store');
    Route::get('/add-user/{user}/show', [OrgUserController::class, 'show'])->name('org.user.show');
    Route::get('/add-user/{user}/edit', [OrgUserController::class, 'edit'])->name('org.user.edit');
    Route::patch('/add-user/{user}/update', [OrgUserController::class, 'update'])->name('org.user.update');
    Route::delete('/add-user/{user}/delete', [OrgUserController::class, 'destroy'])->name('org.user.destroy');

    // Settings
    Route::resource('/financial-months', FinancialMonthController::class);
    Route::resource('/financial-years', FinancialYearController::class);
    Route::resource('/charge-settings', ChargeSettingController::class);
    Route::resource('/asset-types', AssetTypeController::class);
    Route::resource('/liability-types', LiabilityTypeController::class);
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