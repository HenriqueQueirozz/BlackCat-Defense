<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weakness extends Model
{
    use HasFactory;

    protected $table = 'weakness';
    protected $primaryKey = 'weakness_id';

    protected $fillable = [
        'name',
        'description',
        'image', 
        'weakness_point'
    ];

    public function Counter()
    {
        return $this->hasMany('App\Counter');
    }

    public function zumbis(){
        return $this->belongsToMany(Zumbi::class, 'weakness_zumbi');
    }


    public function analisandoFraquezas($desvantagem)
    {
        $fraquezas = Weakness::where('weakness_point', $desvantagem)->first();
        return $fraquezas;
    }
}
