<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Order;  // Import the Order model
use App\Observers\ModelActivityObserver; // Import the Observer

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
        Order::observe(ModelActivityObserver::class);
    }
}
