<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Specify the table if it's different from the pluralized model name
    protected $table = 'bookings'; // Change if your table name is different

    // Specify the primary key if it's different from 'id'
    protected $primaryKey = 'id';

    // Allow mass assignment for these fields
    protected $fillable = [
        'email',
        'adresse',
        'description',
        'nom',
        'numtelephone',
        // Add any other fields you need
    ];

}
