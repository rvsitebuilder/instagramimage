<?php

namespace Rvsitebuilder\InstagramImage;

use Illuminate\Support\ServiceProvider;

class InstagramImageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //$this->registerConfig();

        $this->bootRoute();
        $this->bootView();

        $this->defineVendorPublish();
        $this->defineinject();
    }

    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Boot Route.
     */
    public function bootRoute(): void
    {
        //TODO use cach route
        //$this->loadRoutesFrom( __DIR__.'/../routes', 'core');

        include_route_files(__DIR__.'/../routes');
    }

    public function bootView(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'rvsitebuilder/instagramimage');
    }

    /**
     * boot PublishAsset.
     */
    public function defineVendorPublish(): void
    {
        $this->publishes([__DIR__.'/../public' => public_path('vendor/rvsitebuilder/instagramimage')], 'public');
    }

    /**
     * define Injections.
     */
    public function defineinject(): void
    {
        app('rvsitebuilderService')->inject('toolbar', 'rvsitebuilder/instagramimage::instagramimage');
    }

    /**
     * Register config.
     */
    protected function registerConfig(): void
    {
        //don't have yet
        //$this->mergeConfigFrom(__DIR__.'/../config/config.php', 'rvsitebuilder/instagramimage');
    }
}
