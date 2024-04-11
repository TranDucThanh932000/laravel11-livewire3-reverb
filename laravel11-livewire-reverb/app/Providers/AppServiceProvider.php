<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $classes = [
            'User',
        ];

        foreach ($classes as $class) {
            $this->app->bind(
                "App\Repositories\\{$class}\\{$class}Interface",
                "App\Repositories\\{$class}\\{$class}Repository"
            );
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('viewPulse', function (User $user) {
            return $user->isAdmin();
        });
    }
}
