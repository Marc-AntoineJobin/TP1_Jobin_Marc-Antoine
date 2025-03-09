<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Film extends Model
{
    protected $fillable = [
        'title',
        'description',
        'release_year',
        'language_id',
        'original_language_id',
        'rental_duration',
        'rental_rate',
        'length',
        'replacement_cost',
        'rating',
        'special_features',
        'image',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
    public function critics()
    {
        return $this->hasMany(Critic::class);
    }
    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }
}
