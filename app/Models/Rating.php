<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['certificat_id', 'user_id', 'rating'];

    public function certificat()
    {
        return $this->belongsTo(Certificat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}