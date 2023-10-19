<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZumbiWeakness extends Model
{
    use HasFactory;

    protected $table = 'zumbi_weakness';
    protected $primaryKey = 'weakness_id';

    protected $fillable = [
        'name',
        'description',
        'image', 
        'weakness_point'
    ];

    public function ZumbiCounter()
    {
        return $this->hasMany('App\ZumbiCounter');
    }

    public function analisandoFraquezas($desvantagem)
    {
        $fraquezas = ZumbiWeakness::where('weakness_point', $desvantagem)->get();
        return $fraquezas;
    }
}
