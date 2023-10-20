<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zumbi extends Model
{
    use HasFactory;

    protected $table = 'zumbi';
    protected $primaryKey = 'zumbi_id';

    protected $fillable = [
        'dangerousness',
        'strength', 
        'velocity', 
        'intelligence', 
        'image', 
        'age', 
        'gender', 
        'weight', 
        'height',
        'blood_type',
        'music_style',
        'sport', 
        'favorite_game'
    ];
 
    public function weakness(){
	    return $this->belongsToMany(Weakness::class, 'weakness_zumbi');
    }

    public function strength() {
	    return $this->belongsToMany(Strength::class, 'strength_zumbi');
    }
}
