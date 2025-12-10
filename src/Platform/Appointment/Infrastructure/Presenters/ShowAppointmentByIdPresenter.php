<?php

namespace Src\Platform\Appointment\Infrastructure\Presenters;

use Src\Platform\Appointment\Domain\Contracts\ShowAppointmentByIdPresenterInterface;
use Src\Platform\Appointment\Domain\Entities\Appointment;
use Src\Platform\Appointment\Domain\Entities\AppointmentStatus;
use Src\Platform\Dentist\Domain\Entities\Dentist;
use Src\Platform\Patient\Domain\Entities\Patient;

class ShowAppointmentByIdPresenter implements ShowAppointmentByIdPresenterInterface
{
    protected function __construct(protected Appointment $appointment, protected Dentist $dentist, protected Patient $patient, protected AppointmentStatus $appointmentStatus) {}

    public function read(): array
    {
        return [
            'id' => $this->appointment->getId(),
            'start' => $this->appointment->getStart()->format('Y-m-d H:i:s'),
            'finish' => $this->appointment->getFinish()->format('Y-m-d H:i:s'),
            'description' => $this->appointment->getDescription(),
            'dentist' => [
                'id' => $this->dentist->getId(),
                'name' => $this->dentist->getName(),
                'speciality_id' => $this->dentist->getSpecialityId(),
            ],
            'patient' => [
                'id' => $this->patient->getId(),
                'name' => $this->patient->getName(),
                'email' => $this->patient->getEmail(),
                'phone' => $this->patient->getPhone(),
                'description' => $this->patient->getDescription(),
            ],
            'status' => [
                'id' => $this->appointmentStatus->getId(),
                'label' => $this->appointmentStatus->getLabel(),
            ],
        ];
    }

    public static function write(Appointment $appointment, Dentist $dentist, Patient $patient, AppointmentStatus $appointmentStatus): ShowAppointmentByIdPresenterInterface
    {
        return new ShowAppointmentByIdPresenter($appointment, $dentist, $patient, $appointmentStatus);
    }
}
