<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class Partenaire extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable; 
    protected $fillable = [
        'nom',
        'description',
        'email',
        'adresse',
        'telephone',
        'type'
    ];

    /**
     * Get the certificates associated with the partenaire.
     */
    public function certificats()
    {
        return $this->hasMany(Certificat::class);
    }

    // Méthode pour récupérer les types de transport
    public static function types()
    {
        return ['hebergement', 'transport', 'activite'];
    }
}
