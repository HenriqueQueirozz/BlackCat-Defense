<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZumbiDefenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('zumbi_defense')->insert(
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'defensed_point' => 'S',
            ],
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'defensed_point' => 'V',
            ],
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'defensed_point' => 'I',
            ],
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'defensed_point' => 'SV',
            ],
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'defensed_point' => 'SI',
            ],
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'defensed_point' => 'VI',
            ],
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'defensed_point' => 'SVI',
            ],
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'defensed_point' => '-',
            ],
        );
    }
}
