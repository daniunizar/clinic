<?php

namespace Src\Platform\Appointment\Infrastructure\Repositories;

use App\Models\Appointment as EloquentAppointment;
use App\Models\AppointmentStatus as EloquentAppointmentStatus;
use Src\Platform\Appointment\Domain\Contracts\AppointmentRepositoryInterface;
use Src\Platform\Appointment\Domain\Entities\Appointment;
use Src\Platform\Appointment\Domain\Entities\AppointmentStatus;

class EloquentAppointmentRepository implements AppointmentRepositoryInterface
{
    public function findById(string $appointmentId): ?Appointment
    {
        $eloquentAppointment = EloquentAppointment::find($appointmentId);
        if(!$eloquentAppointment){
            return null;
        }
        return $this->mapToDomain($eloquentAppointment);
    }

    public function getAppointmentsByStartDate(\DateTimeImmutable $date): array
    {
        $date = $date->format('Y-m-d');
        $eloquentAppointmentsArray = EloquentAppointment::query()
            ->whereDate('start', '=', $date)
            ->orderBy('start')
            ->get()
            ->all(); //parse to an array
        return array_map(function($eloquentAppointment){
            return $this->mapToDomain($eloquentAppointment);
        }, $eloquentAppointmentsArray);
    }

    private function mapToDomain(EloquentAppointment $eloquent): Appointment //avoiding n+1
    {
        return new Appointment(
            $eloquent->id,
            $eloquent->patient_id,
            $eloquent->dentist_id,
            new \DateTimeImmutable($eloquent->start),
            new \DateTimeImmutable($eloquent->finish),
            $eloquent->description,
            $eloquent->appointment_status_id
        );
    }

    public function findAppointmentStatusByAppointmentStatusId(string $appointmentStatusId): ?AppointmentStatus
    {
        $eloquentAppointmentStatus = EloquentAppointmentStatus::find($appointmentStatusId);

        if(!$eloquentAppointmentStatus){
            return null;
        };
        return new AppointmentStatus($eloquentAppointmentStatus->id, $eloquentAppointmentStatus->label);
    }
}