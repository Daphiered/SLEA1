<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssessorAccountController;
use App\Http\Controllers\AssessorProfileController;
use App\Http\Controllers\ChangeAssessorPasswordController;
use App\Http\Controllers\SystemMonitoringAndLogController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\LeadershipController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CorSubmissionController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\PendingSubmissionController;
use App\Http\Controllers\SubmissionRecordController;
use App\Http\Controllers\SubmissionOversightController;
use App\Http\Controllers\FinalReviewRequestController;
use App\Http\Controllers\FinalReviewController;
use App\Http\Controllers\AwardReportController;
use App\Http\Controllers\ApprovalAccountController;
use App\Http\Controllers\RubricCategoryController;
use App\Http\Controllers\RubricSectionController;
use App\Http\Controllers\RubricSubsectionController;
use App\Http\Controllers\RubricSubsectionLeadershipController;
use App\Http\Controllers\RubricEditHistoryController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\ManageAccountController;
use App\Http\Controllers\AdminPasswordController;
use App\Http\Controllers\ChangeAdminPasswordController;
use App\Http\Controllers\UpdateProgramController;
use App\Http\Controllers\YearLevelUpdateController;
use App\Http\Controllers\LogInController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\AuthController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

// Dashboard Route
Route::get('/', [DashboardController::class, 'index'])->name('home');

// Assessor System Routes
Route::resource('assessor_accounts', AssessorAccountController::class);
Route::resource('assessor_profiles', AssessorProfileController::class);
Route::resource('change_assessor_passwords', ChangeAssessorPasswordController::class);

// Student Management Routes
Route::resource('students', StudentController::class);
Route::get('/students-table', [StudentController::class, 'table'])->name('students-table');

// Academic Routes
Route::apiResource('academics', AcademicController::class);
Route::get('/academics', [AcademicController::class, 'index'])->name('academics.index');
Route::get('/academics/create', [AcademicController::class, 'create'])->name('academics.create');
Route::post('/academics', [AcademicController::class, 'store'])->name('academics.store');

    // Leadership Routes
    Route::get('/leadership', [LeadershipController::class, 'index'])->name('leadership.index');
    Route::get('/leadership/create', [LeadershipController::class, 'create'])->name('leadership.create');
    Route::post('/leadership', [LeadershipController::class, 'store'])->name('leadership.store');
    Route::get('/leadership/{id}', [LeadershipController::class, 'show'])->name('leadership.show');
    Route::get('/leadership/{id}/edit', [LeadershipController::class, 'edit'])->name('leadership.edit');
    Route::put('/leadership/{id}', [LeadershipController::class, 'update'])->name('leadership.update');
    Route::delete('/leadership/{id}', [LeadershipController::class, 'destroy'])->name('leadership.destroy');

// Profile Routes
Route::resource('profiles', ProfileController::class);

// Change Password Routes
Route::get('/change-password', [ChangePasswordController::class, 'form'])->name('change-password.form');
Route::post('/change-password', [ChangePasswordController::class, 'update'])->name('change-password.update');

// Login Routes
Route::resource('log-in', LogInController::class)->only([
    'index','create','store','show','destroy'
]);

// OTP Routes
Route::resource('otp', OtpController::class)->only([
    'index','create','store','show','destroy'
]);

// Update Program Routes
Route::resource('Update-program', UpdateProgramController::class);

// Year Level Update Routes
Route::get('/year-level', [YearLevelUpdateController::class, 'create'])->name('year-level.create');
Route::post('/year-level', [YearLevelUpdateController::class, 'store'])->name('year-level.store');

// COR Submission Routes
Route::get('/cor', [CorSubmissionController::class, 'index'])->name('cor.index');
Route::get('/cor/create', [CorSubmissionController::class, 'create'])->name('cor.create');
Route::post('/cor', [CorSubmissionController::class, 'store'])->name('cor.store');
Route::get('/cor/{cor_id}/download', [CorSubmissionController::class, 'download'])->name('cor.download');

// Submission Routes
Route::get('submissions', [SubmissionRecordController::class, 'index'])->name('submissions.index');
Route::get('submissions/create', [SubmissionRecordController::class, 'create'])->name('submissions.create');
Route::post('submissions', [SubmissionRecordController::class, 'store'])->name('submissions.store');
Route::get('submissions/{subrec_id}/download', [SubmissionRecordController::class, 'download'])->name('submissions.download');

// Pending Submission Routes
Route::get('pending', [PendingSubmissionController::class, 'index'])->name('pending.index');
Route::get('pending/create', [PendingSubmissionController::class, 'create'])->name('pending.create');
Route::post('pending', [PendingSubmissionController::class, 'store'])->name('pending.store');
Route::get('pending/{pending}/edit', [PendingSubmissionController::class, 'edit'])->name('pending.edit');
Route::put('pending/{pending}', [PendingSubmissionController::class, 'update'])->name('pending.update');

// Assessed Submission Routes
Route::get('assessed-submissions', [SubmissionController::class, 'index'])->name('assessed.index');
Route::post('assessed-submissions', [SubmissionController::class, 'store'])->name('assessed.store');

// Rubric Routes
Route::resource('rubric-categories', RubricCategoryController::class)->parameters([
    'rubric-categories' => 'rubric_category'
]);
Route::resource('rubric-sections', RubricSectionController::class)->parameters([
    'rubric-sections' => 'rubric_section'
]);
Route::resource('rubric-subsections', RubricSubsectionController::class);

// Approval Routes
Route::get('approvals', [ApprovalAccountController::class, 'index'])->name('approvals.index');
Route::post('approvals/{student_id}/approve', [ApprovalAccountController::class, 'approve'])->name('approvals.approve');
Route::post('approvals/{student_id}/reject', [ApprovalAccountController::class, 'reject'])->name('approvals.reject');

// Leadership Subsection Routes
Route::resource('leadership-subsections', RubricSubsectionLeadershipController::class);

// Nested CRUD for edits under a subsection
Route::prefix('leadership-subsections/{subsection}')->group(function () {
    Route::resource('edits', RubricEditHistoryController::class)->parameters([
        'edits' => 'editHistory'
    ]);
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('log-in', LogInController::class);
});

Route::resource('admins', AdminProfileController::class);
Route::resource('accounts', ManageAccountController::class);
Route::get('accounts/{id}/login-activity', [ManageAccountController::class, 'accountLoginActivity'])->name('accounts.login-activity');
Route::get('login-monitoring', [ManageAccountController::class, 'loginMonitoring'])->name('login-monitoring');
Route::post('accounts/{id}/suspend', [ManageAccountController::class, 'suspend'])->name('accounts.suspend');
Route::post('accounts/{id}/activate', [ManageAccountController::class, 'activate'])->name('accounts.activate');
Route::resource('passwords', AdminPasswordController::class);
Route::resource('password-changes', ChangeAdminPasswordController::class);

// Final Review Routes
Route::resource('final-reviews', FinalReviewRequestController::class);

// Submission Oversight Routes
Route::resource('submission_oversights', SubmissionOversightController::class);

// Report Routes
Route::resource('award_reports', AwardReportController::class);
Route::resource('final_reviews', FinalReviewController::class);

// System Monitoring Routes
Route::get('system-logs', [SystemMonitoringAndLogController::class, 'index'])->name('system-logs.index');

// Optional sanity route to confirm routes file is loading:
Route::get('/ping', fn () => 'pong');

use App\Http\Controllers\OrganizationController;

Route::resource('organizations', OrganizationController::class);









