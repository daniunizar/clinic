<?php

namespace Src\Platform\Appointment\Domain\Contracts;

use Src\Platform\Appointment\Domain\Entities\Appointment;

interface LegacyAppointmentRepositoryInterface
{
    public function store(Appointment $appointmentData): string;
}