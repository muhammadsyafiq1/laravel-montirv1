<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','montir_id','jenis_kerusakan','kronologi_kerusakan','berapa_lama_kerusakan','jadwal_penjemputan','alamat_penjemputan','status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function montir()
    {
        return $this->belongsTo(User::class, 'montir_id');
    }
}
