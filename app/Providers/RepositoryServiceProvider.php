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

// Entidades
use App\Repositories\Contracts\EntidadRepositoryInterface;
use App\Repositories\Eloquent\EntidadRepository;

// Usuarios
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\UserRepository;

// Planes
use App\Repositories\Contracts\PlanRepositoryInterface;
use App\Repositories\Eloquent\PlanRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Registrar los repositorios de la aplicación.
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

        // Entidades
        $this->app->bind(
            EntidadRepositoryInterface::class,
            EntidadRepository::class
        );

        // Usuarios
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        // Planes
        $this->app->bind(
            PlanRepositoryInterface::class,
            PlanRepository::class
        );
    }

    /**
     * Inicializar servicios de la aplicación.
     */
    public function boot(): void
    {
        //
    }
}