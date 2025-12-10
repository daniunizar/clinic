<?php

namespace Src\Platform\Appointment\Infrastructure\Presenters;

use Src\Platform\Appointment\Domain\Contracts\ListAppointmentsByStartDatePresenterInterface;

class ListAppointmentsByStartDatePresenter implements ListAppointmentsByStartDatePresenterInterface
{
    protected function __construct(protected array $appointmentsArray)
    {
        
    }

    public function read(): array
    {
        return array_map(function($appointment){
            return [
                'id'=>$appointment->getId(),
                'start'=>$appointment->getStart()->format('Y-m-d H:i:s'),
                'finish'=>$appointment->getFinish()->format('Y-m-d H:i:s'),
            ];
        }, $this->appointmentsArray);
    }

    public static function write(array $appointmentsArray): ListAppointmentsByStartDatePresenterInterface
    {
        return new ListAppointmentsByStartDatePresenter($appointmentsArray);
    }
}