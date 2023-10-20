<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeaknessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('weakness')->insert([
            [
                'weakness_id' => 1,
                'name' => 'Força',
                'description' => '',
                'image' => '',
                'weakness_point' => 'S',
            ],
            [
                'weakness_id' => 2,
                'name' => 'Velocidade',
                'description' => '',
                'image' => '',
                'weakness_point' => 'V',
            ],
            [
                'weakness_id' => 3,
                'name' => 'Inteligencia',
                'description' => '',
                'image' => '',
                'weakness_point' => 'I',
            ],
            [
                'weakness_id' => 4,
                'name' => 'Neutro',
                'description' => '',
                'image' => '',
                'weakness_point' => '-',
            ],
        ]);
    }
}
