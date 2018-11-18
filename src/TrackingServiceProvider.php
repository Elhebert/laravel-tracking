<?php

namespace Elhebert\Tracking;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class TrackingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tracking');

        $this->registerPublishing();
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/tracking.php', 'tracking');
    }

    private function registerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/tracking'),
        ], 'tracking-views');

        $this->publishes([
            __DIR__ . '/../config/tracking.php' => config_path('tracking.php'),
        ], 'tracking-config');
    }
}
