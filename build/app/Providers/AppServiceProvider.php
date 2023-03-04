<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Gate::define('super-privilege', function(User $user) {
            return $user->role === 'observateur';
        });

        Gate::define('manager-privilege', function(User $user) {
            return $user->role === 'manager';
        });

        Gate::define('admin-privilege', function(User $user) {
            return $user->role === 'admin';
        });

        Gate::define('general-privilege', function(User $user) {
            return $user->role === 'general';
        });

        Gate::define('directeur-privilege', function(User $user) {
            return $user->role === 'directeur';
        });

        Gate::define('secretaire-privilege', function(User $user) {
            return $user->role === 'secretaire';
        });

        Gate::define('agent-privilege', function(User $user) {
            return $user->role === 'agent';
        });
    }
}
