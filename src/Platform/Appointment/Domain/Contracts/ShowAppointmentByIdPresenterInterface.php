<?php

namespace Src\Platform\Appointment\Domain\Contracts;

use Src\Platform\Appointment\Domain\Entities\Appointment;
use Src\Platform\Appointment\Domain\Entities\AppointmentStatus;
use Src\Platform\Dentist\Domain\Entities\Dentist;
use Src\Platform\Patient\Domain\Entities\Patient;

interface ShowAppointmentByIdPresenterInterface
{
    public function read(): array;

    public static function write(Appointment $appointment, Dentist $dentist, Patient $patient, AppointmentStatus $appointmentStatus): ShowAppointmentByIdPresenterInterface;
}