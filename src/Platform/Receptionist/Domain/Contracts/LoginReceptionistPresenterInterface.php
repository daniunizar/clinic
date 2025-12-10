<?php

namespace Src\Platform\Receptionist\Domain\Contracts;

use Src\Platform\Receptionist\Domain\Entities\Receptionist;

interface LoginReceptionistPresenterInterface
{
    public function read(): array;

    public function write(Receptionist $receptionist): LoginReceptionistPresenterInterface;
}