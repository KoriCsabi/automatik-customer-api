<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CustomerServices\CustomerService;
use App\Services\CustomerServices\CustomerServiceInterface;
use App\Repositories\CustomerRepositories\CustomerRepository;
use App\Repositories\CustomerRepositories\CustomerRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CustomerServiceInterface::class, CustomerService::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
