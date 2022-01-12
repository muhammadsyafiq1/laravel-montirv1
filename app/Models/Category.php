<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
    	'nama_category','foto'
    ];

    public function User()
    {
    	return $this->hasMany(User::class, 'category_id');
    }
}
