<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pekerjaan_diselesaikan',
        'name',
        'accept_by_admin',
        'email',
        'password',
        'no_hp',
        'alamat',
        'role' ,
        'jenis_kelamin',
        'lingkup_wilayah',
        'category_id',
        'pengalaman',
        'tentang',
        'pekerjaan',
        'nama_bengkel',
        'foto',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function portfolio()
    {
        return $this->hasMany(Portfolio::class , 'user_id');
    }

    public function sertifikat()
    {
        return $this->hasMany(Sertifikat::class , 'user_id');
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }
    public function complain()
    {
        return $this->hasOne(Complain::class, 'user_id');
    }

    public function complainMontir()
    {
        return $this->hasOne(Complain::class, 'montir_id');
    }

    public function ratingMontir()
    {
        return $this->hasOne(Rating::class, 'montir_id');
    }

    public function ratingMontirUser()
    {
        return $this->hasMany(Rating::class, 'user_id');
    }

    public function complainMontirUser()
    {
        return $this->hasOne(Complain::class, 'user_id');
    }
    
}
