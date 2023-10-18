<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZumbiDefense extends Model
{
    use HasFactory;

    protected $table = 'zumbi_defense';
    protected $primaryKey = 'defense_id';

    protected $fillable = [
        'name',
        'description',
        'image', 
        'defensed_point'
    ];

    public function selecionarManobrasDeDefesa($vantagem)
    {
        $defesa = ZumbiDefense::where('defensed_point', $vantagem)->get();
        return $defesa;
    }
}
