<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        foreach (get_declared_classes() as $class) {
            if (is_subclass_of($class, \App\Models\BaseModel::class) && property_exists($class, 'uploadable')) {
                $class::observe(\App\Observers\AttachmentObserver::class);
            }
        }
    }
}
