<?php

namespace App\Providers;
use Schema;
use Illuminate\Support\ServiceProvider;
use App\Repositories\TodoInterfaceWork\EmployersInterface;
// use App\Repositories\TodoInterfaceWork\ShopsRepositories;
use App\Repositories\Work\EmployersEloquen;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(EmployersInterface::class, EmployersEloquen::class);
        // $this->app->singleton(ShopsRepositories::class, ShopsEloquent::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
    }
}
