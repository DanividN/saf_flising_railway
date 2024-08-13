<?php

namespace App\Providers;

use App\Http\View\Composers\NotificationTenenciaComposer;
use App\Http\View\Composers\NotificationVerificacionComposer;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\NotificationComposer;
use App\Http\View\Composers\NotificationGarantiaComposer;
use App\Http\View\Composers\NotificationSupervisionComposer;

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
        View::composer('*', NotificationComposer::class);
        View::composer('*', NotificationSupervisionComposer::class);
        View::composer('*', NotificationTenenciaComposer::class);
        View::composer('*', NotificationVerificacionComposer::class);
        View::composer('*', NotificationGarantiaComposer::class);

        Carbon::setLocale('es');
        $timezone = config('app.timezone');
        date_default_timezone_set($timezone);
        Carbon::setTestNow($timezone);
    }
}
