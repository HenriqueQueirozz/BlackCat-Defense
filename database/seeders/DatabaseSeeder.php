<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\ZumbiSeeder;
use Database\Seeders\ZumbiCounterSeeder;
use Database\Seeders\ZumbiDefenseSeeder;
use Database\Seeders\ZumbiWeaknessSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        ZumbiSeeder::class;
        // ZumbiCounterSeeder::class;
        // ZumbiDefenseSeeder::class;
        // ZumbiWeaknessSeeder::class;
    }
}
