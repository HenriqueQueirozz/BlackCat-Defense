<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('defense')->insert([
            [
                'name' => 'Força',
                'description' => '',
                'image' => '',
                'strength_id' => 1,
            ],
            [
                'name' => 'Velocidade',
                'description' => '',
                'image' => '',
                'strength_id' => 2,
            ],
            [
                'name' => 'Inteliencia',
                'description' => '',
                'image' => '',
                'strength_id' => 3,
            ],
            [
                'name' => 'Neutro',
                'description' => '',
                'image' => '',
                'strength_id' => 4,
            ]
        ]);
    }
}
