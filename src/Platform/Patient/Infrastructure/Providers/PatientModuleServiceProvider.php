<?php

namespace Src\Platform\Patient\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Platform\Patient\Domain\Contracts\PatientRepositoryInterface;
use Src\Platform\Patient\Infrastructure\Repositories\EloquentPatientRepository;

class PatientModuleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            PatientRepositoryInterface::class,
            EloquentPatientRepository::class
        );
    }
}
