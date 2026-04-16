<?php

namespace App\Providers;

use App\Repositories\FuelRepository;
use App\Repositories\ReportRepository;
use App\Repositories\VehicleRepository;
use App\Repositories\VehicleRequestRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(VehicleRepository::class, function ($app) {
            return new VehicleRepository(new \App\Models\Vehicle());
        });

        $this->app->bind(VehicleRequestRepository::class, function ($app) {
            return new VehicleRequestRepository(new \App\Models\VehicleRequest());
        });

        $this->app->bind(FuelRepository::class, function ($app) {
            return new FuelRepository(new \App\Models\FuelRecord());
        });

        $this->app->bind(ReportRepository::class, function ($app) {
            return new ReportRepository();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
