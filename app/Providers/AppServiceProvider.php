<?php

namespace App\Providers;

use App\Models\Person;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Observers\UserObserver;
use App\Observers\PersonObserver;
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
        // The observers are doing NOTHING that laravel doesn't do automatically -z
        // User::observe(UserObserver::class);
        // Person::observe(PersonObserver::class);
        Paginator::useTailwind();
    }
}
