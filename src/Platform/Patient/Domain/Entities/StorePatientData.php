<?php

namespace Src\Platform\Patient\Domain\Entities;

class StorePatientData
{
    public function __construct(
        protected string $name,
        protected string $email,
        protected string $phone,
        protected string $description,
    )
    {
        
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}