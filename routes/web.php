<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DraftController;
use App\Http\Controllers\LHPController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingsController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::resource('draft-lhp', DraftController::class);
    Route::resource('review-draft-lhp', ReviewController::class);
    Route::resource('lhp', LHPController::class);
    Route::resource('account-center', AccountController::class);

    // Routes for the settings resource
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('/settings/edit', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('settings/change-password', [SettingsController::class, 'changePassword'])->name('settings.change-password');
    Route::put('settings/change-password', [SettingsController::class, 'updatePassword'])->name('settings.update-password');


    route::POST('/logout', [AuthController::class, 'logout'])->name('logout');
});


// Admin Login
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'aunthenticate']);