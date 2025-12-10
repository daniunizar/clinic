<?php

namespace Src\Platform\Receptionist\Domain\Entities;

class Receptionist
{
    public function __construct(
        protected string $id,
        protected string $name,
        protected string $email,
        protected string $hashedPassword
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getHashedPassword(): string
    {
        return $this->hashedPassword;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'password' => $this->getHashedPassword(),
        ];
    }
}