<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,

        // Custom Global Middleware
        \App\Http\Middleware\LocaleMiddleware::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [],
        'api' => [],
    ];

    /**
     * The application's middleware aliases.
     *
     * Aliases may be used instead of class names to conveniently assign middleware to routes and groups.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        // Custom Middleware Aliases
        'locale' => \App\Http\Middleware\LocaleMiddleware::class,
        'permission' => \App\Http\Middleware\CheckPermission::class,
        'admin' => \App\Http\Middleware\AdminUsermiddleware::class,
    ];

    protected $routeMiddleware = [
        // other middlewares
        'permission' => \App\Http\Middleware\CheckPermission::class,
    ];
}
