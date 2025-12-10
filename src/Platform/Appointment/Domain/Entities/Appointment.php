<?php

namespace Src\Platform\Appointment\Domain\Entities;

class Appointment
{
    public function __construct(
        protected string $id,
        protected string $patientId,
        protected string $dentistId,
        protected \DateTimeImmutable $start,
        protected \DateTimeImmutable $finish,
        protected string $description,
        protected string $appointmentStatusId
    )
    {
        
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPatientId(): string
    {
        return $this->patientId;
    }

    public function getDentistId(): string
    {
        return $this->dentistId;
    }

    public function getStart(): \DateTimeImmutable
    {
        return $this->start;
    }

    public function getFinish(): \DateTimeImmutable
    {
        return $this->finish;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStatusId(): string
    {
        return $this->appointmentStatusId;
    }
}