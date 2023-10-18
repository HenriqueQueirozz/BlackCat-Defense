<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZumbiCounter extends Model
{
    use HasFactory;

    protected $table = 'zumbi_counter';
    protected $primaryKey = 'counter_id';

    protected $fillable = [
        'name',
        'description',
        'image', 
        'exploded_point'
    ];

    public function selecionarManobrasDeAtaque($desvantagem)
    {
        $contra_ataque = ZumbiCounter::where('exploded_point', $desvantagem)->get();
        return $contra_ataque;
    }

}

