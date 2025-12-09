<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Treatment;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class TreatmentSeeder extends Seeder
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
                'label'=>'limpieza',
                'price_in_cents'=>50000,
            ],
            [
                'label'=>'radiografía',
                'price_in_cents'=>100000,

            ],
            [
                'label'=>'implante',
                'price_in_cents'=>400000,
            ],
        ];

        foreach ($items as $item) {
            try {
                $object = new Treatment($item);
                $object->save();
            } catch (Exception $e) {
                Log::error('Error en el seeder: '.$e->getMessage());
            }
        }
    }
}
