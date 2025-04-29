<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
    
    // routes built for assignment
    Route::resource('course', CourseController::class);

    Route::get('assessment/{id}', [AssessmentController::class ,'show'])
                ->name('assessment.show');

    Route::post('assessment/store', [AssessmentController::class ,'store'])
                ->name('assessment.store');
    Route::post('assessment/update/{id}', [AssessmentController::class, 'update'])
                ->name('assessment.update');

    Route::resource('review', ReviewController::class);

    Route::get('join/group', [GroupController::class, 'joinGroup'])
                ->name('join.group');

    Route::post('assign', [GroupController::class, 'assignStudent'])
                ->name('updateGroup_type');

    Route::get('reviewer/rates', [UserController::class, 'reviewerRates'])
                ->name('reviewerRates');

    Route::get('all-students', [UserController::class, 'allstudentsList'])
                ->name('all_students_list');

    Route::resource('score', ScoreController::class);

    Route::post('enroll', [EnrollmentController::class, 'enrollStudent'])
                ->name('enrollment.enroll');

    Route::post('upload-file', [FileUploadController::class, 'uploadFile'])
                ->name('upload_file');
});
