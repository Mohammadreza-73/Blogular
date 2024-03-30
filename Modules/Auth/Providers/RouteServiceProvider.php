<?php

namespace Modules\Auth\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    private string $moduleNamespace = 'Modules\Auth\Http\Controllers';

    private array $moduleMiddleware = ['web'];

    private string $moduleWebRoutePath = '/../Routes/web.php';

    private string $moduleRoutePrefix = 'auth';

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
            ->prefix($this->moduleRoutePrefix)
            ->name($this->moduleRoutePrefix.'.')
            ->group(__DIR__.$this->moduleWebRoutePath);
    }
}
