<?php

namespace App\Modules\Users\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Modules\Users\Http\Controllers';

    protected $routes = 'app/Modules/Users/Http/Routes/';

    public function boot()
    {
    }

    public function register()
    {
        $this->app->router->group([
            'namespace' => $this->namespace,
            'middleware' => 'auth'
        ], function ($router) {
            require base_path($this->routes . 'api.php');
        });
    }
}
