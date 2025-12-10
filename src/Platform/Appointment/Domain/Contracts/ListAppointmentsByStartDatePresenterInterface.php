<?php

namespace Src\Platform\Appointment\Domain\Contracts;

interface ListAppointmentsByStartDatePresenterInterface
{
    public function read(): array;

    public static function write(array $appointmentsArray): ListAppointmentsByStartDatePresenterInterface;
}