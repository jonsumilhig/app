<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('', [\App\Http\Controllers\Profile\ProfileController::class, 'index'])->name('index');
        Route::patch('information/{user}', [\App\Http\Controllers\Profile\UpdateProfileInformationController::class, 'update'])->name('update.information');
        Route::patch('photo/{user}', [\App\Http\Controllers\Profile\UpdateProfileInformationController::class, 'deleteProfilePhoto'])->name('update.photo');
        Route::delete('logout/session/{user}', [\App\Http\Controllers\Profile\LogoutOtherBrowserSessionController::class, 'destroy'])->name('destroy.logout.session');
        Route::patch('password/{user}', [\App\Http\Controllers\Profile\UpdatePasswordController::class, 'update'])->name('update.password');
        Route::delete('delete/{user}', [\App\Http\Controllers\Profile\DeleteAccountController::class, 'destroy'])
            ->name('destroy');
    });
});

