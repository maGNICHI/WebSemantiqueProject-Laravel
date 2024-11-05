<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeLoveGreen extends Model
{
    use HasFactory;
    protected $fillable = ['description','lieu','nom'];
}
