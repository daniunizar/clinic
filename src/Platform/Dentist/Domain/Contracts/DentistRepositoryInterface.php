<?php

namespace Src\Platform\Dentist\Domain\Contracts;

use Src\Platform\Dentist\Domain\Entities\StoreDentistData;

interface DentistRepositoryInterface
{
    public function store(StoreDentistData $storeDentistData): string;
}