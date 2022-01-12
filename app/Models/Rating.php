<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id','montir_id','stars_rated'
    ];

    public function review()
    {
    	return $this->hasMany(Review::class, 'rating_id');
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
