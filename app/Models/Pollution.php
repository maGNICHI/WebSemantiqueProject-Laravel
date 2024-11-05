<?php

// app/Models/Pollution.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pollution extends Model
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
