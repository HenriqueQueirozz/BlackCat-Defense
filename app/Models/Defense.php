<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Defense extends Model
{
    use HasFactory;

    protected $table = 'defense';
    protected $primaryKey = 'defense_id';

    protected $fillable = [
        'name',
        'description',
        'image', 
        'strength_id'
    ];

    function ZumbiStrenghness() {
        return $this->belongsTo('App\Strength');
    }
}
