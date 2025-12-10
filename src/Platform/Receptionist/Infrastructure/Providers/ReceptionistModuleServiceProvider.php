<?php

namespace Src\Platform\Receptionist\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Platform\Receptionist\Domain\Contracts\PasswordHasherInterface;
use Src\Platform\Receptionist\Domain\Contracts\ReceptionistRepositoryInterface;
use Src\Platform\Receptionist\Domain\Contracts\TokenServiceInterface;
use Src\Platform\Receptionist\Infrastructure\Repositories\EloquentReceptionistRepository;
use Src\Platform\Receptionist\Infrastructure\Services\JwtTokenService;
use Src\Platform\Receptionist\Infrastructure\Services\LaravelPasswordHasherService;

class ReceptionistModuleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            ReceptionistRepositoryInterface::class,
            EloquentReceptionistRepository::class
        );
        $this->app->bind(
            PasswordHasherInterface::class,
            LaravelPasswordHasherService::class
        );
        $this->app->bind(
            TokenServiceInterface::class,
            JwtTokenService::class
        );
    }
}
