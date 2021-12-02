<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\AdminHomeController;
use App\Mail\ResponesToUser;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/{lang}/livewire/message/{name}', '\Livewire\Controllers\HttpConnectionHandler');


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
        // Route::view('/', 'admin.home')->name('home');
        Route::get('/', [AdminHomeController::class, 'index'])->name('home');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::view('profile', 'admin.profile.profile')->name('profile');
        //roles
        Route::view('roles', 'admin.roles.index')->name('roles.index');
        Route::view('roles/create', 'admin.roles.create')->name('roles.create');
        Route::view('roles/{role}', 'admin.roles.edit')->name('roles.edit');
        //admins
        Route::view('admins', 'admin.admins.admins')->name('admins');
        //categories
        Route::view('categories', 'admin.categories.categories')->name('categories');
        // courses
        Route::view('courses', 'admin.courses.courses')->name('courses');
        // countries
         Route::view('countries', 'admin.countries.countries')->name('countries');
         // cities
         Route::view('cities', 'admin.cities.cities')->name('cities');
         // instructors
         Route::view('instructors', 'admin.instructors.instructors')->name('instructors');
         // students
         Route::view('students', 'admin.students.students')->name('students');
         //reports
         Route::view('reports/students', 'admin.reports.students')->name('reports.students');
         Route::view('reports/countries', 'admin.reports.countries')->name('reports.countries');
         Route::view('reports/courses', 'admin.reports.courses')->name('reports.courses');
         //settings
         Route::view('settings', 'admin.settings.settings')->name('settings');
        //end of admin auth routes
    });
    //guest admin routes
    Route::middleware(['admin.guest'])->group(function () {
        Route::view('login', 'admin.auth.login')->name('login');
        Route::view('/forget-password', 'admin.auth.forgotten-password')->name('forget-password-form');
        Route::view('/password/reset/{token}/{email}', 'admin.auth.reset-password')->name('password.reset');
        Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
        //end of admin gust routes
    });
	/** End Of Admin ROUTES GROUP **/
    });
});
