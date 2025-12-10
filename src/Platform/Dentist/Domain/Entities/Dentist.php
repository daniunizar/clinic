<?php

namespace Src\Platform\Dentist\Domain\Entities;

class Dentist
{
    public function __construct(
        protected string $id,
        protected string $name,
        protected string $speciality_id,
    )
    {
        
    }

    public function getId(): string
    {
        return $this->id;
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