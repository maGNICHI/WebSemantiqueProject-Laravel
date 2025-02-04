<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'reclamation_id'];

    public function reclamation()
    {
        return $this->belongsTo(Reclamation::class);
    }
}