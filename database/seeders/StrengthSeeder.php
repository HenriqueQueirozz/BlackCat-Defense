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
                'name' => 'ZUMBII ESMAGAA',
                'description' => 'Se esse zumbi fosse mais musculoso poderia facilmente ser confundido com o HULK.',
                'image' => '',
                'fortification_point' => 'S',
            ],
            [
                'name' => 'Zumbi Bolt',
                'description' => 'Semelhante ao um ex grudento, ele não vai sair do seu pé (literalmente, esse é maratonista).',
                'image' => '',
                'fortification_point' => 'V',
            ],
            [
                'name' => 'Elementar meu caro Watson',
                'description' => 'O que esse zumbi faz impressiona até Albert Einsten, de um papel e uma caneta para ele e teremos os mistérios da matéria escura resolvidos.',
                'image' => '',
                'fortification_point' => 'I',
            ],
            [
                'name' => 'Padrão',
                'description' => 'É um zumbi padrão, eu acho que estar VIVO depois de morto já é um ponto forte muito grande.',
                'image' => '',
                'fortification_point' => '-',
            ],
        ]);
    }
}
