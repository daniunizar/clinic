<?php

namespace Src\Platform\Appointment\Domain\Contracts;

use Src\Platform\Appointment\Domain\Entities\Appointment;

interface AppointmentRepositoryInterface
{
    public function findById(string $appointmentId): ?Appointment;

    public function getAppointmentsByStartDate(\DateTimeImmutable $date): array;
}