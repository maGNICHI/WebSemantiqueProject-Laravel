<?php

// app/Models/Securite.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Securite extends Model
{
    use HasFactory;

    protected $fillable = [
        'sujet',
        'description',
        'status',
        'date_reclamation',
        'date_traitement',
    ];
}
