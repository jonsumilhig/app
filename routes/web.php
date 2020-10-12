<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Profile\DeleteAccountController;
use App\Http\Controllers\Profile\LogoutOtherBrowserSessionController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\TwoFactorAuthenticationController;
use App\Http\Controllers\Profile\UpdatePasswordController;
use App\Http\Controllers\Profile\UpdateProfileInformationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('', [ProfileController::class, 'index'])->name('index');

        Route::patch('information/{user}', [UpdateProfileInformationController::class, 'update'])->name('update.information');
        Route::patch('photo/{user}', [UpdateProfileInformationController::class, 'deleteProfilePhoto'])->name('update.photo');

        Route::patch('enable/twoFactorAuthentication/{user}', [TwoFactorAuthenticationController::class, 'enable'])->name('enable.twoFactorAuthentication');
        Route::patch('disable/twoFactorAuthentication/{user}', [TwoFactorAuthenticationController::class, 'disable'])->name('disable.twoFactorAuthentication');
        Route::patch('regenerate/twoFactorAuthentication/{user}', [TwoFactorAuthenticationController::class, 'regenerate'])->name('regenerate.twoFactorAuthentication');

        Route::delete('logout/session/{user}', [LogoutOtherBrowserSessionController::class, 'destroy'])->name('destroy.logout.session');

        Route::patch('password/{user}', [UpdatePasswordController::class, 'update'])->name('update.password');

        Route::delete('delete/{user}', [DeleteAccountController::class, 'destroy'])->name('destroy');
    });
});

