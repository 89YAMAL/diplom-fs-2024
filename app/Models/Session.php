<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 
        'session_start', 
        'length_px', 
        'id_hall', 
        'name_hall', 
        'config_hall', 
        'id_film', 
        'active'
    ];

    public function hall() 
    {
        return $this->hasOne(Hall::class, 'id', 'hall_id');
    }

    public function film() 
    {
        return $this->hasOne(Film::class, 'id', 'film_id');
    }
}
