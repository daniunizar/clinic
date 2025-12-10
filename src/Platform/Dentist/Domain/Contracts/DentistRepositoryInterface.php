<?php

namespace Src\Platform\Dentist\Domain\Contracts;

use Src\Platform\Dentist\Domain\Entities\Dentist;
use Src\Platform\Dentist\Domain\Entities\StoreDentistData;

interface DentistRepositoryInterface
{
    public function findById(string $dentistId): ?Dentist;

    public function store(StoreDentistData $storeDentistData): string;
}