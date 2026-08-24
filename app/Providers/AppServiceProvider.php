<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Contracts\PndRepositoryInterface;
use App\Repositories\Eloquent\PndRepository;

use App\Repositories\Contracts\OdsRepositoryInterface;
use App\Repositories\Eloquent\OdsRepository;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}