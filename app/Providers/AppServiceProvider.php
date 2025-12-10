<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(\Src\Platform\Receptionist\Infrastructure\Providers\ReceptionistModuleServiceProvider::class);
        $this->app->register(\Src\Platform\Patient\Infrastructure\Providers\PatientModuleServiceProvider::class);
        $this->app->register(\Src\Platform\Dentist\Infrastructure\Providers\DentistModuleServiceProvider::class);
    }

    /**
     * Bootstrap any application services.s
     */
    public function boot(): void
    {
        //
    }
}
