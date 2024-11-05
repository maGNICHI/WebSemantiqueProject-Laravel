<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Activite extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'contenu', 'image', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function avis()
    {
        return $this->hasMany(Avis::class);
    }
    public function likes()
    {
        return $this->belongsToMany(User::class, 'activite_likes', 'activite_id', 'user_id')->withTimestamps();
    }

    public function isLikedBy(User $user = null)
    {
        $user = $user ?: Auth::user(); // Use the passed user or the authenticated user
        if (!$user) {
            return false; // If no user is logged in, return false
        }

        return $this->likes()->where('user_id', $user->id)->exists();
    }
    

}
