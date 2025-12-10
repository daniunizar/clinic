<?php

namespace Src\Platform\Dentist\Application;

use Illuminate\Auth\Access\AuthorizationException;
use Src\Platform\Dentist\Domain\Contracts\DentistRepositoryInterface;
use Src\Platform\Dentist\Domain\Entities\StoreDentistData;
use Src\Platform\Receptionist\Domain\Contracts\ReceptionistRepositoryInterface;

class StoreDentistUseCase
{
    public function __construct(
        protected ReceptionistRepositoryInterface $receptionistRepository,
        protected DentistRepositoryInterface $dentistRepository
    )
    {
        
    }

    public function execute(string $name, string $speciality_id, string $receptionistId): string
    {
        //check current user is receptionist
        $receptionist = $this->receptionistRepository->findReceptionistById($receptionistId);
        if(!$receptionist){
            throw new AuthorizationException();
        }
        
        //store dentist
        $storeDentistData = new StoreDentistData($name, $speciality_id);
        return $this->dentistRepository->store($storeDentistData);
    }
}