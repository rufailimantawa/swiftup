<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceProvidersController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index', [
    'pageTitle' => config("app.name")
])->middleware('guest');

Route::controller(AuthController::class)->group(function () {
    Route::match(['get', 'post'], '/register', 'register')->name('auth.register');
    Route::match(['get', 'post'], '/login', 'login')->name('auth.login');
    Route::get('/logout', 'logout')->name('auth.logout');

    Route::match(['get', 'post'], '/forgot-password', 'forgotPassword')->name('password.request');
    Route::match(['get', 'post'], '/reset-password', 'resetPassword')->name('password.reset');
});

Route::prefix('/user')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('user.dashboard');
        Route::get('/profile', 'profile')->name('user.profile');
        Route::match(['get', 'post'], '/edit', 'edit')->name('user.edit');
        Route::match(['get', 'post'], '/change-pin', 'changePin')->name('user.change-pin');
        Route::match(['get', 'post'], '/change-password', 'changePassword')->name('user.change-password');
    });

    Route::controller(VerificationController::class)->group(function() {
        Route::get('/email/verify', 'notice')->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify');
        Route::post('/email/resend', 'resend')->name('verification.resend');
    });
})->middleware('auth');

Route::prefix('/admin')->group(function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('admin.index');
    Route::name('admin.')->group(function () {
        Route::resources([
            'roles' => RoleController::class,
            'users' => AdminUserController::class,
            'providers' => ServiceProvidersController::class,
        ]);
    });
});
