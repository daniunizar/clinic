<?php

namespace Src\Platform\Dentist\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Platform\Dentist\Domain\Contracts\DentistRepositoryInterface;
use Src\Platform\Dentist\Infrastructure\Repositories\EloquentDentistRepository;

class DentistModuleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            DentistRepositoryInterface::class,
            EloquentDentistRepository::class
        );
    }
}
