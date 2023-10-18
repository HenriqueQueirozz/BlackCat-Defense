<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\ZumbiSeeder;
use Database\Seeders\ZumbiCounterSeeder;
use Database\Seeders\ZumbiDefenseSeeder;
use Database\Seeders\ZumbiWeaknessSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('zumbi')->insert(
            [
                'dangerousness' => 'Muita Alta',
                'strength' => 100,
                'velocity' => 100,
                'intelligence' => 100,
                'image' => 'paciente0.jpg',
                'age' => '32',
                'gender' => 'F',
                'weight' => 28,
                'height' => 0.80,
                'blood_type' => 'AB+',
                'music_style' => 'Pagode',
                'sport' => 'Atletismo',
                'favorite_game' => 'Minecraft',
            ]
        );
        // ZumbiSeeder::class;
        // ZumbiCounterSeeder::class;
        // ZumbiDefenseSeeder::class;
        // ZumbiWeaknessSeeder::class;
    }
}
