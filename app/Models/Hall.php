<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'config', 
        'standart_price', 
        'vip_price'
    ];

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
