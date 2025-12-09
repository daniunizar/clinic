<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AppointmentStatus;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class AppointmentStatusSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $items = [
            [
                'label'=>'pendiente',
            ],
            [
                'label'=>'calcelada',
            ],
            [
                'label'=>'completada',
            ],
        ];

        foreach ($items as $item) {
            try {
                $object = new AppointmentStatus($item);
                $object->save();
            } catch (Exception $e) {
                Log::error('Error en el seeder: '.$e->getMessage());
            }
        }
    }
}
