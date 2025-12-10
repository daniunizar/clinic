<?php

namespace Src\Platform\Receptionist\Infrastructure\Services;

use Illuminate\Support\Facades\Hash;
use Src\Platform\Receptionist\Domain\Contracts\PasswordHasherInterface;

class LaravelPasswordHasherService implements PasswordHasherInterface
{
    public function check(string $plainPassword, string $hashedPassword): bool
    {
        return Hash::check($plainPassword, $hashedPassword);
    }

    public function hash(string $plainPassword): string
    {
        return Hash::make($plainPassword);
    }
}