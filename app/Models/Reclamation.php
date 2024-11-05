<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Reclamation extends Model
{
    use HasFactory;

    protected $fillable = ['sujet', 'description', 'etat', 'user_id']; 



    public function reponses()
    {
        return $this->hasMany(Reponse::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
