<?php

namespace Src\Platform\Appointment\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Legacy\Database as LegacyDatabase;
use Src\Platform\Appointment\Domain\Contracts\AppointmentRepositoryInterface;
use Src\Platform\Appointment\Domain\Contracts\LegacyAppointmentRepositoryInterface;
use Src\Platform\Appointment\Domain\Contracts\ListAppointmentsByStartDatePresenterInterface;
use Src\Platform\Appointment\Infrastructure\Presenters\ListAppointmentsByStartDatePresenter;
use Src\Platform\Appointment\Infrastructure\Repositories\EloquentAppointmentRepository;
use Src\Platform\Appointment\Infrastructure\Repositories\LegacyAppointmentRepository;

class AppointmentModuleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            AppointmentRepositoryInterface::class,
            EloquentAppointmentRepository::class
        );
        $this->app->bind(
            ListAppointmentsByStartDatePresenterInterface::class,
            ListAppointmentsByStartDatePresenter::class
        );
        $this->app->singleton(LegacyDatabase::class, function ($app) {
            $pdo = \DB::getPdo();// Uses the PDO of Laravel from the .env
            return new LegacyDatabase($pdo);
        });
        $this->app->bind(LegacyAppointmentRepositoryInterface::class, function ($app) {
            return new LegacyAppointmentRepository($app->make(LegacyDatabase::class));
        });
    }
}
