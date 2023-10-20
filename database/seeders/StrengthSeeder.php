<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StrengthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('strength')->insert([
            [
                'strength_id' => 1,
                'name' => 'Força',
                'description' => '',
                'image' => '',
                'fortification_point' => 'S',
            ],
            [
                'strength_id' => 2,
                'name' => 'Velocidade',
                'description' => '',
                'image' => '',
                'fortification_point' => 'V',
            ],
            [
                'strength_id' => 3,
                'name' => 'Inteligencia',
                'description' => '',
                'image' => '',
                'fortification_point' => 'I',
            ],
            [
                'strength_id' => 4,
                'name' => 'Neutro',
                'description' => '',
                'image' => '',
                'fortification_point' => '-',
            ]
        ]);
    }
}
