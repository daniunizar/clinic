<?php

namespace Src\Platform\Receptionist\Infrastructure\Presenters;

use Src\Platform\Receptionist\Domain\Contracts\LoginReceptionistPresenterInterface;
use Src\Platform\Receptionist\Domain\Entities\Receptionist;

class LoginReceptionistPresenter implements LoginReceptionistPresenterInterface
{
    private function __construct(
        protected Receptionist $receptionist
    )
    {
        
    }

    public function read(): array
    {
        return [
            'id' => $this->receptionist->getId(),
            'name' => $this->receptionist->getName(),
            'email' => $this->receptionist->getEmail(),
        ];
    }

    public function write(Receptionist $receptionist): LoginReceptionistPresenterInterface
    {
        return new LoginReceptionistPresenter($receptionist);
    }
}