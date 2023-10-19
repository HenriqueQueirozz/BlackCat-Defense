<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZumbiStrenghness extends Model
{
    use HasFactory;

    protected $table = 'zumbi_strengthness';
    protected $primaryKey = 'strengthness_id';

    protected $fillable = [
        'name',
        'description',
        'image', 
        'fortification_point'
    ];

    public function ZumbiDefense()
    {
        return $this->hasMany('App\ZumbiDefense');
    }

}
