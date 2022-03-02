<?php

namespace zoparga\EasyBill;

use Illuminate\Support\ServiceProvider;

class EasybillServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/config/easybill.php' => config_path('easybill.php'),
            ], 'config');
        }
    }

    public function register()
    {
        $this->app->singleton('easybill', function ($app) {
            if (config('easybill.api_key') === null) {
                throw new \Exception('Missing easybill.de API-Key in config!');
            }

            return new EasyBill(config('easybill.api_key'));
        });

        $this->mergeConfigFrom(__DIR__ . '/config/easybill.php', 'easybill');
    }
}
