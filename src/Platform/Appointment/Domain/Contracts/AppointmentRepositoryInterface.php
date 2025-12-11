<?php

namespace Src\Platform\Appointment\Domain\Contracts;

use Src\Platform\Appointment\Domain\Entities\Appointment;
use Src\Platform\Appointment\Domain\Entities\AppointmentStatus;

interface AppointmentRepositoryInterface
{
    public function findById(string $appointmentId): ?Appointment;

    public function getAppointmentsByStartDate(\DateTimeImmutable $date): array;

    // Appointmen Statuses
    public function findAppointmentStatusByAppointmentStatusId(string $appointmentStatusId): ?AppointmentStatus;
    
    public function findAppointmentStatusByAppointmentStatusLabel(string $appointmentLabel): ?AppointmentStatus;
}