<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Repositories\Eloquent\RoleRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Registrar los repositorios de la aplicación.
     */
    public function register(): void
    {
        $this->app->bind(
            RoleRepositoryInterface::class,
            RoleRepository::class
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