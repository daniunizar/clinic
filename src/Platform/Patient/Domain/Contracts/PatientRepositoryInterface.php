<?php

namespace Src\Platform\Patient\Domain\Contracts;

use Src\Platform\Patient\Domain\Entities\Patient;
use Src\Platform\Patient\Domain\Entities\StorePatientData;

interface PatientRepositoryInterface
{
    public function findById(string $patientId): ?Patient;

    public function store(StorePatientData $storePatientData): string;
}