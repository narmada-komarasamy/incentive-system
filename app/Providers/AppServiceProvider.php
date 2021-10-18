<?php

namespace App\Providers;

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
        //Using contextual binding to bind the needed incentive module based on request received
        $this->app->when(IncentivesController::class)
        ->needs(IncentivesInterfaceModule::class)
        ->give(function () {
            return request()->incentiveId === '1'
                ? $this->app->get(IncentiveEvent1Module::class)
                : $this->app->get(IncentiveEvent2Module::class);
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
