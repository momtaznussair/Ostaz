<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetCitiesController;
use App\Http\Controllers\GetCountriesController;
use App\Http\Controllers\Api\Auth\TokenController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//get available counties and cities
Route::get('countries', GetCountriesController::class);
Route::get('cities/{country_id}', GetCitiesController::class);
// Auth
Route::post('login', [TokenController::class, 'login']);
Route::post('register', [TokenController::class, 'register']);
