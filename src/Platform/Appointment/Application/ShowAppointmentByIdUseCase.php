<?php

namespace Src\Platform\Appointment\Application;

use Illuminate\Auth\Access\AuthorizationException;
use Src\Platform\Appointment\Domain\Contracts\AppointmentRepositoryInterface;
use Src\Platform\Appointment\Infrastructure\Presenters\ShowAppointmentByIdPresenter;
use Src\Platform\Dentist\Domain\Contracts\DentistRepositoryInterface;
use Src\Platform\Patient\Domain\Contracts\PatientRepositoryInterface;
use Src\Platform\Receptionist\Domain\Contracts\ReceptionistRepositoryInterface;

class ShowAppointmentByIdUseCase
{
    public function __construct(
        protected ReceptionistRepositoryInterface $receptionistRepository,
        protected AppointmentRepositoryInterface $appointmentRepository,
        protected DentistRepositoryInterface $dentistRepository,
        protected PatientRepositoryInterface $patientRepository,
    )
    {
        
    }

    public function execute(string $appointmentId, string $receptionistId): ShowAppointmentByIdPresenter
    {
        //check current user is receptionist
        $receptionist = $this->receptionistRepository->findReceptionistById($receptionistId);
        if(!$receptionist){
            throw new AuthorizationException();
        }

        //get appointment by Id
        $appointment = $this->appointmentRepository->findById($appointmentId);

        //get dentist
        $dentist = $this->dentistRepository->findById($appointment->getDentistId());
        
        //get patient
        $patient = $this->patientRepository->findById($appointment->getPatientId());

        //get appointment status
        $appointmentStatus = $this->appointmentRepository->findAppointmentStatusByAppointmentStatusId($appointment->getStatusId());

        return ShowAppointmentByIdPresenter::write($appointment, $dentist, $patient, $appointmentStatus);
    }
}