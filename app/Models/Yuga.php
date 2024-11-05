<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yuga extends Model
{
    use HasFactory;
    protected $fillable = ['titre','description'];
}
