<?php

namespace Src\Platform\Dentist\Domain\Entities;

class StoreDentistData
{
    public function __construct(
        protected string $name,
        protected string $speciality_id,
    )
    {
        
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSpecialityId(): string
    {
        return $this->speciality_id;
    }
}