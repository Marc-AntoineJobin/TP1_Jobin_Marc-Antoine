<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Language extends Model
{
    protected $fillable = [
        'id',
        'name',
    ];

    public function films()
    {
        return $this->hasMany(Film::class);
    }
}
