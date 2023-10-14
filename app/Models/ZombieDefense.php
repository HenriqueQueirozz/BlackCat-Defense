<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZombieDefense extends Model
{
    use HasFactory;

    protected $table = 'zombie_defense';
    protected $primaryKey = 'id_defense';

    protected $fillable = [
        'nome',
        'descricao',
        'imagem', 
        'ponto_explorado'
    ];

    protected $dates = ['deleted_at'];
}
