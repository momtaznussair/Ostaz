<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],
function()
{
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

    Route::group([
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'as' => 'admin.',        
    ],
    function ()
    {
	/** ADD ALL Admin ROUTES INSIDE THIS GROUP **/

    //Authenticated admins routes
    Route::middleware(['admin.auth'])->group(function () {
        Route::view('/', 'admin.home')->name('home');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        //end of admin auth routes
    });
    //guest admin routes
    Route::middleware(['admin.guest'])->group(function () {
        Route::view('login', 'admin.auth.login')->name('login');
        Route::view('/forget-password', 'admin.auth.forgotten-password')->name('forget-password-form');
        // Route::get('/password/reset/{token}/{email}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::view('/password/reset/{token}/{email}', 'admin.auth.reset-password')->name('password.reset');
        Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
        //end of admin gust routes
    });
	/** End Of Admin ROUTES GROUP **/
    });
});
