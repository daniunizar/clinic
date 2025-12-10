<?php

namespace Src\Platform\Appointment\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Platform\Appointment\Domain\Contracts\AppointmentRepositoryInterface;
use Src\Platform\Appointment\Domain\Contracts\ListAppointmentsByStartDatePresenterInterface;
use Src\Platform\Appointment\Infrastructure\Presenters\ListAppointmentsByStartDatePresenter;
use Src\Platform\Appointment\Infrastructure\Repositories\EloquentAppointmentRepository;

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
    }
}
