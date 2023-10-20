<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('counter')->insert([
            [
                'name' => 'Força',
                'description' => '',
                'image' => '',
                'weakness_id' => 1,
            ],
            [
                'name' => 'Velocidade',
                'description' => '',
                'image' => '',
                'weakness_id' => 2,
            ],
            [
                'name' => 'Inteligencia',
                'description' => '',
                'image' => '',
                'weakness_id' => 3,
            ],
            [
                'name' => 'Neutro',
                'description' => '',
                'image' => '',
                'weakness_id' => 4,
            ]
        ]);
    }
}
