<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZumbiWeaknessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('zumbi_weakness')->insert(
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'weakness_point' => 'S',
            ],
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'weakness_point' => 'V',
            ],
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'weakness_point' => 'I',
            ],
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'weakness_point' => 'SV',
            ],
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'weakness_point' => 'SI',
            ],
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'weakness_point' => 'VI',
            ],
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'weakness_point' => 'SVI',
            ],
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'weakness_point' => '-',
            ],
        );
    }
}
