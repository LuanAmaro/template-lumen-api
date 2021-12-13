<?php

namespace App\Modules\Auth\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Modules\Auth\Http\Controllers';

    protected $routes = 'app/Modules/Auth/Http/Routes/';

    public function boot()
    {
    }

    public function register()
    {
        $this->app->router->group([
            'namespace' => $this->namespace
        ], function ($router) {
            require base_path($this->routes . 'api.php');
        });
    }
}
