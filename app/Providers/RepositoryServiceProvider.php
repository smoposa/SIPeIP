<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Repositories\Eloquent\RoleRepository;

use App\Repositories\Contracts\EntidadRepositoryInterface;
use App\Repositories\Eloquent\EntidadRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Registrar los repositorios de la aplicación.
     */
    public function register(): void
    {
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
    }

    /**
     * Inicializar servicios de la aplicación.
     */
    public function boot(): void
    {
        //
    }
}