<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;


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
        Paginator::useBootstrapFive();
        // bikin gate / pagar
        Gate::define('admin', function(User $user) {
            return $user->is_admin;
        });
        Gate::define('operator', function(User $user) {
            return $user->id === 1;
        });
    }
}
