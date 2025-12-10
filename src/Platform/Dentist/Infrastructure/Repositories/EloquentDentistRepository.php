<?php

namespace Src\Platform\Dentist\Infrastructure\Repositories;

use App\Models\Dentist as EloquentDentist;
use Src\Platform\Dentist\Domain\Contracts\DentistRepositoryInterface;
use Src\Platform\Dentist\Domain\Entities\StoreDentistData;

class EloquentDentistRepository implements DentistRepositoryInterface
{
    public function store(StoreDentistData $storeDentistData): string
    {
        $eloquentDentist = EloquentDentist::create([
            'name' => $storeDentistData->getName(),
            'speciality_id'=>$storeDentistData->getSpecialityId(),
        ]);

        return $eloquentDentist->id;
    }
}