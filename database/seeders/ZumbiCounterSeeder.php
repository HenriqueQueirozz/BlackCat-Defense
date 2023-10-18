<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZumbiCounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('zumbi_counter')->insert(
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'exploded_point' => 'S',
            ],
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'exploded_point' => 'V',
            ],
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'exploded_point' => 'I',
            ],
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'exploded_point' => 'SV',
            ],
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'exploded_point' => 'SI',
            ],
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'exploded_point' => 'VI',
            ],
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'exploded_point' => 'SVI',
            ],
            [
                'name' => '',
                'description' => '',
                'image' => '',
                'exploded_point' => '-',
            ],
        );
    }
}
