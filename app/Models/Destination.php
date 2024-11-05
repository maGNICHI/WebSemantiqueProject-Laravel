<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description', 'adresse', 'latitude', 'longitude'];

    // Relation avec les événements
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    // Méthode pour récupérer les types de destination (optionnelle, selon ton besoin)
    public static function types()
    {
        return ['plage', 'montagne', 'ville', 'campagne'];
    }
      // Relation avec les itinéraires
      public function itineraires()
      {
          return $this->hasMany(Itineraire::class);
      }
}
