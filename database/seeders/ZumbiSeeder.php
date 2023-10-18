<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZumbiSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
            ],
        );
    }
}
