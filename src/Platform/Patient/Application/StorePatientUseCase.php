<?php

namespace Src\Platform\Patient\Application;

use Illuminate\Auth\Access\AuthorizationException;
use Src\Platform\Patient\Domain\Contracts\PatientRepositoryInterface;
use Src\Platform\Patient\Domain\Entities\StorePatientData;
use Src\Platform\Receptionist\Domain\Contracts\ReceptionistRepositoryInterface;

class StorePatientUseCase
{
    public function __construct(
        protected PatientRepositoryInterface $patientRepository,
        protected ReceptionistRepositoryInterface $receptionistRepository
    )
    {
        
    }

    public function execute(string $name, string $email, string $phone, string $description, string $receptionistId): string
    {
        //check current user is receptionist
        $receptionist = $this->receptionistRepository->findReceptionistById($receptionistId);
        if(!$receptionist){
            throw new AuthorizationException();
        }
        
        //store patient
        $storePatientData = new StorePatientData($name, $email, $phone, $description);
        return $this->patientRepository->store($storePatientData);
    }
}