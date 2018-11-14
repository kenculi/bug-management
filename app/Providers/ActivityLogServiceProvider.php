<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\ActivityLog;

class ActivityLogServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('activityLog', function ($app) {
            return new ActivityLog();
        });

        $this->app->alias('activityLog', 'App\Helpers\ActivityLog');
    }
}
