<?php

namespace App\Providers;

use App\Repositories\AddressRepository;
use App\Repositories\SupplierRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SupplierRepository::class, function ($app) {
            return new SupplierRepository();
        });

        $this->app->singleton(AddressRepository::class, function ($app) {
            return new AddressRepository();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
