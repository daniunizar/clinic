<?php

namespace Src\Platform\Receptionist\Domain\Contracts;

use Src\Platform\Receptionist\Domain\Entities\Receptionist;

interface ReceptionistRepositoryInterface
{
    public function findReceptionistByEmail(string $email): ?Receptionist;
}