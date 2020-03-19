<?php

namespace App\Providers;
use Schema;
use Illuminate\Support\ServiceProvider;
use App\Repositories\TodoInterfaceWork\EmployersInterface;
use App\Repositories\TodoInterfaceWork\SupportInterface;
use App\Repositories\TodoInterfaceWork\CompanyInterface;
use App\Repositories\TodoInterfaceWork\FormMCaLamInterface;
use App\Repositories\TodoInterfaceWork\WorkShilftsInterface;
use App\Repositories\Work\WorkShiftsEloquent;
use App\Repositories\Work\FormMCalamEloquent;
use App\Repositories\Work\CompanyEloquent;
use App\Repositories\Work\EmployersEloquen;
use App\Repositories\Work\SupportEloquent;
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
        $this->app->singleton(SupportInterface::class, SupportEloquent::class);
        $this->app->singleton(CompanyInterface::class, CompanyEloquent::class);
        $this->app->singleton(WorkShilftsInterface::class, WorkShiftsEloquent::class);
        $this->app->singleton(FormMCaLamInterface::class, FormMCalamEloquent::class);
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
