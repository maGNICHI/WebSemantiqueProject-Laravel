<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description', 'date_debut', 'date_fin', 'destination_id', 'image'];

    // Relation avec la destination
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    // Méthode pour récupérer les types d'événements (optionnelle, selon ton besoin)
    public static function types()
    {
        return ['concert', 'festival', 'exposition', 'conférence'];
    }
}
