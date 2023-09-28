<?php

namespace Gunsnroses\LaravelDatatable;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Gunsnroses\LaravelDatatable\Console\Commands\MakeDatatable;
use Gunsnroses\LaravelDatatable\DatatableView;

class DatatableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Blade::component('datatable', DatatableView::class);
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'datatable');

        // Publishing the assets.
        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('vendor/datatable'),
        ], 'assets');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('datatable.php'),
            ], 'config');

            // Publishing the views.
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/datatable'),
            ], 'views');

            // Registering package commands.
            $this->commands([
                MakeDatatable::class,
            ]);
        }
    }

    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'datatable');
    }
}
