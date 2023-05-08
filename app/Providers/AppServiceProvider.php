<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
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
        //
        Carbon::setLocale('id');

        Paginator::useBootstrapFour();

        // Gate::define('isAdmin', function ($admin) {

        //     return $admin instanceof Admin && $admin->id === 1;
        // });

    }
}
