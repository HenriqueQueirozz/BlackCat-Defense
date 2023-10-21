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
                'name' => 'Sansão careca',
                'description' => 'Pense na pessoa mais forte do mundo! Agora tire toda sua força, bom, esse zumbi ainda perderia.',
                'image' => '',
                'weakness_point' => 'S',
            ],
            [
                'name' => 'Rubinho Barrichello',
                'description' => 'Por mais que ele tente muito MUITO te alcançar, ele não vai conseguir :(',
                'image' => '',
                'weakness_point' => 'V',
            ],
            [
                'name' => 'Lag mental',
                'description' => 'Andar, enchergar e pensar, os simples estímulos do dia a dia já são demais para esse zumbi.',
                'image' => '',
                'weakness_point' => 'I',
            ],
            [
                'name' => 'Padrão',
                'description' => 'É um zumbi padrão, está em decomposição e tals, e bom é um MORTO-VIVO, provavelmente seus músculos já estão danificados, nenhum ponto marcante.',
                'image' => '',
                'weakness_point' => '-',
            ],
        ]);
    }
}
