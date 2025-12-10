<?php

namespace Src\Platform\Receptionist\Application;

use Src\Platform\Receptionist\Domain\Contracts\PasswordHasherInterface;
use Src\Platform\Receptionist\Domain\Contracts\ReceptionistRepositoryInterface;
use Src\Platform\Receptionist\Domain\Contracts\TokenServiceInterface;
use Src\Platform\Receptionist\Domain\Exceptions\InvalidCredentialsException;

class LoginReceptionistUseCase
{
    public function __construct(
        protected ReceptionistRepositoryInterface $receptionistRepository,
        protected PasswordHasherInterface $passwordHasher,
        protected TokenServiceInterface $tokenService
    )
    {
    }

    public function execute(string $email, string $password): string
    {
        $receptionist = $this->receptionistRepository->findReceptionistByEmail($email);
        if(!$this->passwordHasher->check($password, $receptionist->getHashedPassword())){
            throw new InvalidCredentialsException('Invalid email or password');
        }

        return $this->tokenService->generateToken($receptionist);
    }
}