<?php

namespace Src\Platform\Patient\Infrastructure\Repositories;

use App\Models\Patient as EloquentPatient;
use Src\Platform\Patient\Domain\Contracts\PatientRepositoryInterface;
use Src\Platform\Patient\Domain\Entities\StorePatientData;

class EloquentPatientRepository implements PatientRepositoryInterface
{
    public function store(StorePatientData $storePatientData): string
    {
        $eloquentPatient = EloquentPatient::create([
            'name' => $storePatientData->getName(),
            'email'=>$storePatientData->getEmail(),
            'phone'=>$storePatientData->getPhone(),
            'description'=>$storePatientData->getDescription(),
        ]);

        return $eloquentPatient->id;
    }
}