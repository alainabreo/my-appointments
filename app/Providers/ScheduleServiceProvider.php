<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\ScheduleServiceInterface;
use App\Services\ScheduleService;

class ScheduleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //Registra el servicio bajo esta interface
        $this->app->bind(ScheduleServiceInterface::class, ScheduleService::class);
    }
}
