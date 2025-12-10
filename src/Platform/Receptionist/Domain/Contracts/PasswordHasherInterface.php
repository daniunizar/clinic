<?php

namespace Src\Platform\Receptionist\Domain\Contracts;

interface PasswordHasherInterface
{
    public function hash(string $plainPassword): string;
    
    public function check(string $plainPassword, string $hashedPassword): bool;
}