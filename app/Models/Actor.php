<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Actor extends Model
{
    protected $fillable = [
        "id", 
        "first_name",
        "last_name",
        "birthdate",
    ];
    public function film()
    {
        return $this->belongsToMany(Film::class);
    }
}
