<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fedex extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural form of the model
    protected $table = 'fedex';

    // Specify the fillable fields
    protected $fillable = [
        'email',
        'adresse',
        'description',
        'nom',
        'numtelephone',
    ];
}
