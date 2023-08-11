<?php

namespace App\Providers;

use App\Facades\PurchaseFacade;
use App\Services\PurchaseService;
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
        PurchaseFacade::shouldProxyTo(PurchaseService::class);
    }
}
