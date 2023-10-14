<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZombieWeakness extends Model
{
    use HasFactory;

    protected $table = 'zombies_weakness';
    protected $primaryKey = 'id_weakness';

    protected $fillable = [
        'nome',
        'descricao',
        'imagem', 
        'ponto_explorado'
    ];

    protected $dates = ['deleted_at'];
}
