<?php

namespace Modules\Auth\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    private string $moduleNamespace = 'Modules\Auth\Http\Controllers';

    private array $moduleMiddleware = ['web'];

    private string $moduleWebRoutePath = '/../Routes/web.php';

    public function boot()
    {
        //
    }

    public function map()
    {
        $this->mapWebRoutes();
    }

    private function mapWebRoutes()
    {
        Route::middleware($this->moduleMiddleware)
            ->namespace($this->moduleNamespace)
            ->group(__DIR__.$this->moduleWebRoutePath);
    }
}