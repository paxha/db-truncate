<?php


namespace DBTruncate;


use Carbon\Laravel\ServiceProvider;
use DBTruncate\Console\DBTruncate;

class DBTruncateServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                DBTruncate::class
            ]);
        }
    }
}
