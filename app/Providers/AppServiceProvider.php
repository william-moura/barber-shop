<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
