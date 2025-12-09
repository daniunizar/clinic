<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Speciality;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class SpecialitySeeder extends Seeder
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
                'label'=>'ortodoncia',
            ],
            [
                'label'=>'implantes',
            ],
        ];

        foreach ($items as $item) {
            try {
                $object = new Speciality($item);
                $object->save();
            } catch (Exception $e) {
                Log::error('Error en el seeder: '.$e->getMessage());
            }
        }
    }
}
