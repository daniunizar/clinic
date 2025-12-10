<?php

namespace Src\Platform\Appointment\Application;

use Illuminate\Auth\Access\AuthorizationException;
use Src\Platform\Appointment\Domain\Contracts\AppointmentRepositoryInterface;
use Src\Platform\Appointment\Infrastructure\Presenters\ListAppointmentsByStartDatePresenter;
use Src\Platform\Receptionist\Domain\Contracts\ReceptionistRepositoryInterface;

class ListAppointmentsByStartDateUseCase
{
    public function __construct(
        protected ReceptionistRepositoryInterface $receptionistRepository,
        protected AppointmentRepositoryInterface $appointmentRepository,
    )
    {
        
    }

    public function execute(\DateTimeImmutable $startDate, string $receptionistId): ListAppointmentsByStartDatePresenter
    {
        //check current user is receptionist
        $receptionist = $this->receptionistRepository->findReceptionistById($receptionistId);
        if(!$receptionist){
            throw new AuthorizationException();
        }

        //get appointments
        $appointmentsArray = $this->appointmentRepository->getAppointmentsByStartDate($startDate);

        return ListAppointmentsByStartDatePresenter::write($appointmentsArray);

    }
}