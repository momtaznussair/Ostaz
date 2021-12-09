<?php

use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetCitiesController;
use App\Http\Controllers\GetCountriesController;
use App\Http\Controllers\Api\Auth\TokenController;
use App\Http\Controllers\Api\Profile\ProfileController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    //auth
    Route::post('logout', [TokenController::class, 'logout']);
    //profile
    Route::get('profile', [ProfileController::class, 'profile']);
    Route::post('update-basic-data', [ProfileController::class, 'updateBasicData']);
    Route::post('update-address-phone', [ProfileController::class, 'updateAddressAndPhone']);
    Route::post('update-password', [ProfileController::class, 'updatePassword']);
    
});

//get available counties and cities
Route::get('countries', GetCountriesController::class);
Route::get('cities/{country_id}', GetCitiesController::class);
// Auth
Route::post('login', [TokenController::class, 'login']);
Route::post('register', [TokenController::class, 'register']);
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLink']);
Route::post('reset-password', [ResetPasswordController::class, 'resetPassword']);
//just for testing
Route::get('reset-password/{token}', function ($token)
{
    return $token;
})->name('reset-password');
