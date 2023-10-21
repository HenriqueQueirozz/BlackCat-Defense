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
                'name' => 'Bolha de proteção',
                'description' => 'Uma bolha de mágica de proteção, aguenta diversas pancadas, apara projéties, resumindo, um ótimo lugar para passar umas férias, 0 bugs, 0 problemas.',
                'image' => 'bolha.jpg',
                'strength_id' => 1,
            ],
            [
                'name' => 'Escudos de penas',
                'description' => 'Penas geneticamente modificadas crescem rapidamente em torno do pato, sua resistência é similar ao aço, a defesa PERFEITA!',
                'image' => 'escudo.jpg',
                'strength_id' => 1,
            ],
            [
                'name' => 'Patas turbo',
                'description' => 'Botas metálicas com propulsores a jato, não pega nuncaaa, coma nossa poeira.',
                'image' => 'turbo.jpg',
                'strength_id' => 2,
            ],
            [
                'name' => 'Voo de emêrgencia',
                'description' => 'Fugir não deveria ser vergonha, é uma "saída estratégica", o voo é uma saída estratégica elegante.',
                'image' => 'voo.jpg',
                'strength_id' => 2,
            ],
            [
                'name' => 'Disfarce de zumbi',
                'description' => 'Um pato zumbi... Serio, você atacaria um Pato zumbi? NÃO!! É o plano perfeito.',
                'image' => 'disfarce.jgp',
                'strength_id' => 3,
            ],
            [
                'name' => 'Dança frenética',
                'description' => 'Uma série de passos de dança sensacionais, deslumbrantes e frenéticos, quando eles entenderem o que está acontecendo, o show já acabou.',
                'image' => 'danca.jpg',
                'strength_id' => 3,
            ],
        ]);
    }
}
