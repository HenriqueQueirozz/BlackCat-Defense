<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Strength extends Model
{
    use HasFactory;

    protected $table = 'strength';
    protected $primaryKey = 'strength_id';

    protected $fillable = [
        'name',
        'description',
        'image', 
        'fortification_point'
    ];

    public function Defense()
    {
        return $this->hasMany('App\Defense');
    }

    public function zumbis(){
	    return $this->belongsToMany(Zumbi::class, 'strength_zumbi');
    }

    public function analisandoFortificacoes($vantagem)
    {
        $fortificacoes = Strength::where('fortification_point', $vantagem)->first();
        return $fortificacoes;
    }
}
