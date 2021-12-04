<?php

namespace App\Providers;

use App\Helpers\GetModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        foreach(App::call(new GetModels)->add('Role') as $model){
         $this->app->bind("App\Contracts\\{$model}RepositoryInterface", "App\Repositories\\{$model}Repository");
        }
    }
    
    public function boot()
    {
        //
    }

}
