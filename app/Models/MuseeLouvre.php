<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MuseeLouvre extends Model
{
    use HasFactory;
    protected $fillable = ['titre','description']; // Assurez-vous que les champs sont inclus ici

}
