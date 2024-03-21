<?php

namespace Modules\Admin\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    private string $moduleNamespace = 'Modules\Admin\Http\Controllers';

    private array $moduleMiddleware = ['web', 'auth'];

    private string $moduleWebRoutePath = '/../Routes/web.php';

    private string $moduleRoutePrefix = 'admin';

    public function boot()
    {
        parent::boot();
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
            ->name($this->moduleRoutePrefix . '.')
            ->group(__DIR__.$this->moduleWebRoutePath);
    }
}