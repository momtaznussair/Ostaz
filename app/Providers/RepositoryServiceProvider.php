<?php

namespace App\Providers;

use App\Contracts\AdminRepositoryInterface;
use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\RoleRepositoyInterface;
use App\Repositories\AdminRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\RoleRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Role
        $this->app->bind(RoleRepositoyInterface::class, RoleRepository::class);
        //Admin
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        //Category
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
