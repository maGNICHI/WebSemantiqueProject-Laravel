<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avion extends Model
{
    use HasFactory;


    // Les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'prix',
        'description',
    ];


}