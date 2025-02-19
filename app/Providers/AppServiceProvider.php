<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use App\Http\Middleware\RoleMiddleware;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register role middleware manually
        $this->app->singleton('role', function () {
            return new RoleMiddleware();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Router $router) 
    {
        // Register the middleware globally
        $router->aliasMiddleware('role', RoleMiddleware::class);
    }
}
