<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','review','montir_id','rating_id'
    ];

    public function rating()
    {
        return $this->belongsTo(Rating::class, 'rating_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function montir()
    {
        return $this->belongsTo(User::class, 'montir_id');
    }
}
