<?php

namespace Src\Platform\Appointment\Application;

use Src\Platform\Appointment\Domain\Contracts\AppointmentRepositoryInterface;
use Src\Platform\Appointment\Domain\Contracts\LegacyAppointmentRepositoryInterface;
use Src\Platform\Receptionist\Domain\Contracts\ReceptionistRepositoryInterface;
use Illuminate\Support\Str;
use Src\Platform\Appointment\Domain\Entities\Appointment;

class StoreAppointmentUseCase
{
    public function __construct(
        protected ReceptionistRepositoryInterface $receptionistRepository,
        protected AppointmentRepositoryInterface $appointmentRepository,
        protected LegacyAppointmentRepositoryInterface $legacyAppointmentRepository,
        )
    {
    }

    public function execute(array $data): string
    {
        //parse to DateTime and calculate finish
        $start = new \DateTimeImmutable($data['date'] . ' '.$data['time']);
        $startCloned = clone $start; //avoid modify start, so clone
        
        //check duration_in_minutes and set in 30 minutes if it is empty
        if(!$data['duration_in_minutes']){
            $data['duration_in_minutes']=30;
        }
        
        $finish = $startCloned->add(new \DateInterval("PT{$data['duration_in_minutes']}M")); //add duration in minutes
        
        //get default appointment status
        $appointmentStatus = $this->appointmentRepository->findAppointmentStatusByAppointmentStatusLabel('pendiente');
        if(!$appointmentStatus){
            throw new \Exception('No se pudo encontrar el estado de cita por defecto');
        }

        //generate new uuid
        $id = (string) Str::uuid();
        
        // prepare Data
        $appointmentData = new Appointment(
            $id,
            $data['patient_id'],
            $data['dentist_id'],
            $start,
            $finish,
            $data['description'],
            $appointmentStatus->getId()
        );

        return $this->legacyAppointmentRepository->store($appointmentData);
    }
}