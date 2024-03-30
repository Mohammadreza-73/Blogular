<?php

namespace Modules\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    private string $name = 'Admin';

    private string $viewPath = '/../Resources/Views';

    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->loadViewFiles();
    }

    private function loadViewFiles(): void
    {
        $this->loadViewsFrom(__DIR__.$this->viewPath, $this->name);
    }
}
