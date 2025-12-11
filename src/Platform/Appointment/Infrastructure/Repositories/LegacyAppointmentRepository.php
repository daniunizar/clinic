<?php

namespace Src\Platform\Appointment\Infrastructure\Repositories;

use Legacy\Database as LegacyDatabase;
use Legacy\Services\AppointmentCreator as LegacyAppointmentCreator;
use Src\Platform\Appointment\Domain\Contracts\LegacyAppointmentRepositoryInterface;
use Src\Platform\Appointment\Domain\Entities\Appointment;

final class LegacyAppointmentRepository implements LegacyAppointmentRepositoryInterface
{
    private LegacyAppointmentCreator $creator;

    public function __construct(LegacyDatabase $legacyDatabase)
    {
        $this->creator = new LegacyAppointmentCreator($legacyDatabase);
    }

    public function store(Appointment $appointmentData): string
    {
        return $this->creator->create($appointmentData);
    }
}