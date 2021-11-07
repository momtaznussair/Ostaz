<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthController;
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

        Route::view('forgotton-password', 'admin.auth.forgotten-password')->name('forgotten-password');
        Route::post('forgotton-password', [AuthController::class, 'sendResetLink'])->name('send-rest-link');
        
        //end of admin gust routes
    });
	/** End Of Admin ROUTES GROUP **/
    });
});

Route::get('/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('password-reset', [AuthController::class, 'restPassword'])->name('password.update');
