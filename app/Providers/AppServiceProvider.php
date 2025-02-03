<?php

namespace App\Providers;

use App\Interfaces\JobListingInterface;
use App\Interfaces\JobListingRepositoryInterface;
use App\Repositories\JobListingRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(JobListingInterface::class, JobListingRepository::class);
        // $this->app->bind(ApplicationRepositoryInterface::class, ApplicationRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
