<?php

namespace App\Providers;

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
        view()->composer(['admin.*', 'includes.adminSidebar'], AdminPanelComposer::class);
        view()->composer(['worker.*','includes.workerSidebar'], WorkerPanelComposer::class);
    }
}
