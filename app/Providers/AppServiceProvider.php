<?php

namespace App\Providers;

use App\Interfaces\JobApplicationInterface;
use App\Interfaces\JobListingInterface;
use App\Repositories\JobApplicationRepository;
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
        $this->app->bind(JobApplicationInterface::class, JobApplicationRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
