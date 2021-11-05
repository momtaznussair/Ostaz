<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],
function()
{
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

    Route::group([
        'prefix' => 'admin',
        'namespace' => 'Admin',

    ],
    function ()
    {
	/** ADD ALL Admin ROUTES INSIDE THIS GROUP **/

    Route::view('/', 'admin.home');
        
    });
	
});