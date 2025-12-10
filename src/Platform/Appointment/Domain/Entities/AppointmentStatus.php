<?php

namespace Src\Platform\Appointment\Domain\Entities;

class AppointmentStatus
{
    public function __construct(
        protected string $id,
        protected string $label
    )
    {
        
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLabel(): string
    {
        return $this->label;
    }
}