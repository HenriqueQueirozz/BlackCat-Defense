<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZombieCounter extends Model
{
    use HasFactory;

    protected $table = 'zombie_counter';
    protected $primaryKey = 'id_counter';

    protected $fillable = [
        'nome',
        'descricao',
        'imagem', 
        'ponto_explorado'
    ];

    protected $dates = ['deleted_at'];
}
