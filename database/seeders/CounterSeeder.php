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
            // [
            //     'name' => 'Quack nuclear',
            //     'description' => 'Semelhante a arma mais mortal da humanidade, a bomba "Quack nuclear" detonar todos os mortos-vivos do local, não há força que resista.',
            //     'image' => '',
            //     'weakness_id' => 1,
            // ],
            [
                'name' => 'Bazooka de migalhas de pão',
                'description' => 'Armamento pesado, 4kg de pão, polvora e muito ódio, todos os zumbis serão pulverizados.',
                'image' => 'bazooka.jpeg',
                'weakness_id' => 1,
            ],
            [
                'name' => 'Granada de ovos',
                'description' => 'Parecem inofensivas, mas seu estrago é grande, CUIDADO COM OS OVOS MEXIDOS!!',
                'image' => 'granada.jpeg',
                'weakness_id' => 2,
            ],
            [
                'name' => 'Canhão de água',
                'description' => 'Uma quantidade torrencial de água, projetada em alta velocidade, não deixa nenhum zumbi chegar perto, imagina se pega no olho',
                'image' => 'canhao.jgp',
                'weakness_id' => 2,
            ],
            // [
            //     'name' => 'Enxurrada de fake news',
            //     'description' => 'São tantas informações absurdas e sem confirmação de fonte, que não tem jeito, qualquer cerebro travaria.',
            //     'image' => '',
            //     'weakness_id' => 3,
            // ],
            [
                'name' => 'Katana de pena',
                'description' => 'Um dialogo pode resolver muitas coisas, mas a violência com certeza encerra todas >:).',
                'image' => 'katana.jpeg',
                'weakness_id' => 3,
            ],
        ]);
    }
}
