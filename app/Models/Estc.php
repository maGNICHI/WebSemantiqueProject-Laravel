<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estc extends Model
{
    use HasFactory;
    protected $fillable = [
        'impact_environnemental',
        'lieu',
        'nom',
        'description'
    ];
}
