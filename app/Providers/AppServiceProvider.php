<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// PND
use App\Repositories\Contracts\PndRepositoryInterface;
use App\Repositories\Eloquent\PndRepository;

// ODS
use App\Repositories\Contracts\OdsRepositoryInterface;
use App\Repositories\Eloquent\OdsRepository;

// Roles
use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Repositories\Eloquent\RoleRepository;

// Usuarios
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\UserRepository;

// Entidades
use App\Repositories\Contracts\EntidadRepositoryInterface;
use App\Repositories\Eloquent\EntidadRepository;

// Planes
use App\Repositories\Contracts\PlanRepositoryInterface;
use App\Repositories\Eloquent\PlanRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // PND
        $this->app->bind(
            PndRepositoryInterface::class,
            PndRepository::class
        );

        // ODS
        $this->app->bind(
            OdsRepositoryInterface::class,
            OdsRepository::class
        );

        // Roles
        $this->app->bind(
            RoleRepositoryInterface::class,
            RoleRepository::class
        );

        // Usuarios
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        // Entidades
        $this->app->bind(
            EntidadRepositoryInterface::class,
            EntidadRepository::class
        );

        // Planes
        $this->app->bind(
            PlanRepositoryInterface::class,
            PlanRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}