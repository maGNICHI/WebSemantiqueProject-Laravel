<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'organisme_emetteur',
        'date_attribution',
        'date_expiration',
        'partenaire_id'
    ];

    public function partenaire()
    {
        return $this->belongsTo(Partenaire::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    public function isRatedBy(User $user = null)
    {
        $user = $user ?: Auth::user(); // Use the passed user or the authenticated user
        if (!$user) {
            return false; // If no user is logged in, return false
        }

        return $this->ratings()->where('user_id', $user->id)->exists();
    }
}
