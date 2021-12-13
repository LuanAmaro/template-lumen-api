<?php

namespace  App\Bootstrap\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;

class AppServiceProvider extends ServiceProvider
{
    private $providers = 'Modules/*/Providers/ModuleServiceProvider.php';

    private $provider = 'App\\Modules\\%s\\Providers\\ModuleServiceProvider';

    public function register()
    {
        $this->getProviders()->each(function ($provider) {
            $this->app->register($provider);
        });
    }

    private function getProviders()
    {
        $files = array_map(function ($file) {
            preg_match("/Modules\/(.*)\/Providers/", $file, $output);
            return sprintf($this->provider, $output[1]);
        }, glob(app()->basePath('app') ."/". $this->providers));

        return new Collection($files);
    }
}
