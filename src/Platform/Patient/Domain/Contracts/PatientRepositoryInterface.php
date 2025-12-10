<?php

namespace Src\Platform\Patient\Domain\Contracts;

use Src\Platform\Patient\Domain\Entities\StorePatientData;

interface PatientRepositoryInterface
{
    public function store(StorePatientData $storePatientData): string;
}