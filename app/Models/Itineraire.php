<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itineraire extends Model
{
    protected $fillable = ['nom', 'description', 'duree', 'destination_id'];

    public function transports()
    {
        return $this->hasMany(Transport::class);
    }
    // Relation avec la destination
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
