<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zombie extends Model
{
    use HasFactory;

    protected $table = 'zombie';
    protected $primaryKey = 'id';

    protected $fillable = [
        'periculosidade',
        'forca', 
        'velocidade', 
        'inteligencia', 
        'imagem', 
        'idade', 
        'sexo', 
        'peso', 
        'altura',
        'tipo_sanguineo',
        'estilo_musical',
        'esporte', 
        'jogo'
    ];

    protected $dates = ['deleted_at'];
}
