<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrapFive();

        foreach (get_declared_classes() as $class) {
            if (is_subclass_of($class, \App\Models\BaseModel::class) && property_exists($class, 'uploadable')) {
                $class::observe(\App\Observers\AttachmentObserver::class);
            }
        }

        View::composer('dashboard.*', function ($view) {
            $view->with('dashboardUser', auth('admin')->user() ?? auth('doctor')->user());
        });

        // فحص الصلاحيات في لوحة التحكم يستخدم guard admin (لأن الافتراضي قد يكون web فيصبح auth()->user() = null)
        Gate::before(function (?object $user, string $ability): ?bool {
            $admin = auth('admin')->user();
            if ($admin && ($user === null || $user->getAuthIdentifier() === $admin->getAuthIdentifier())) {
                if (method_exists($admin, 'hasRole') && $admin->hasRole('super')) {
                    return true;
                }
                if (method_exists($admin, 'can') && $admin->can($ability)) {
                    return true;
                }
            }
            return null;
        });
    }
}
