<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Blade::component('components.auth-validation-errors', 'auth-validation-errors');
        Blade::component('components.auth-card', 'auth-card');
        Blade::component('components.label', 'label');
        Blade::component('components.input', 'input');
        Blade::component('components.button', 'button');
        Blade::component('components.link', 'link');
        Blade::component('components.alert', 'alert');
        Blade::component('components.validation-error', 'validation-error');
    }
}
