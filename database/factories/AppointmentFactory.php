<?php

namespace Database\Factories;

use App\Models\Dentist;
use App\Models\Patient;
use App\Models\AppointmentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //get or create patient
        $patient = Patient::inRandomOrder()->first();
        if (! $patient) {
            $patient = Patient::factory()->create();
        }
        
        //get or create dentist
        $dentist = Dentist::inRandomOrder()->first();
        if (! $dentist) {
            $dentist = Dentist::factory()->create();
        }
        
        //set start time, and end time 1 hour late
        $start = Carbon::instance($this->faker->dateTimeBetween('now', '+30 days'));
        $finish = (clone $start)->addHour(); // +1 hour
        
        //set default appointment status
        $appointment_status = AppointmentStatus::whereIn('label', ['pendiente', 'cancelada'])->inRandomOrder()->first();
        if (! $appointment_status) {
            $appointment_status = AppointmentStatus::factory()->create();
        }

        return [
            'patient_id' => $patient->id,
            'dentist_id' => $dentist->id,
            'start'      => $start,
            'finish'     => $finish,
            'description' => $this->faker->sentence(6),
            'appointment_status_id' => $appointment_status->id,
        ];
    }
}
