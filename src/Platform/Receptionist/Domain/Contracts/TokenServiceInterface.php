<?php

namespace Src\Platform\Receptionist\Domain\Contracts;

use Src\Platform\Receptionist\Domain\Entities\Receptionist;

interface TokenServiceInterface
{
    public function generateToken(Receptionist $user): string; //returns JWT
    public function validateToken(string $token): ?string; //returns receptionistId

}
