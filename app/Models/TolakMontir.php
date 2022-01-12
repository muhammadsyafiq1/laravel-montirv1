<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TolakMontir extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','montir_id','alasan_penolakan'
    ];

    public function montir()
    {
        return $this->belongsTo(User::class, 'montir_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
