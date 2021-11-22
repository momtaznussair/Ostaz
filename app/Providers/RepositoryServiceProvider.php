<?php

namespace App\Providers;

use App\Repositories\CityRepository;
use App\Repositories\RoleRepository;
use App\Repositories\AdminRepository;
use App\Repositories\CourseRepository;
use App\Repositories\CountryRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Contracts\RoleRepositoyInterface;
use App\Contracts\CityRepositoryInterface;
use App\Contracts\AdminRepositoryInterface;
use App\Contracts\CourseRepositoryInterface;
use App\Contracts\CountryRepositoryInterface;
use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\UserMessagesRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Repositories\UserMessagesRepository;
use App\Repositories\UserRepository;

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
        //course
        $this->app->bind(CourseRepositoryInterface::class, CourseRepository::class);
        //Country
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        //City
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        //User
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        //UserMessages
        $this->app->bind(UserMessagesRepositoryInterface::class, UserMessagesRepository::class);
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
