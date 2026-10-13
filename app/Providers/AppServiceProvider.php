<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Barbershop\Domain\Repositories\BarbershopRepositoryInterface;
use Src\Barbershop\Infrastructure\Persistence\BarbershopRepository;
use Src\Domain\Customer\Repositories\CustomerRepositoryInterface;
use Src\Infrastructure\Customer\Persistence\CustomerRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            CustomerRepositoryInterface::class, 
            CustomerRepository::class
        );
        $this->app->bind(
            BarbershopRepositoryInterface::class, 
            BarbershopRepository::class
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
