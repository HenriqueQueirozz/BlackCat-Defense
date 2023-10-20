<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\ZumbiSeeder;
use Database\Seeders\CounterSeeder;
use Database\Seeders\DefenseSeeder;
use Database\Seeders\WeaknessSeeder;
use Database\Seeders\StrengthSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ZumbiSeeder::class,
            WeaknessSeeder::class,
            StrengthSeeder::class,
            CounterSeeder::class,
            DefenseSeeder::class,
        ]);
    }
}
