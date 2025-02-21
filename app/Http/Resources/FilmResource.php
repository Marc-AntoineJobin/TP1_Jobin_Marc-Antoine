<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return ['title' => $this->title,
        'description' => $this->description,
        'release_year'  => $this->release_year,
        'language_id' => $this->language_id,
        'original_language_id' => $this->original_language_id,
        'rental_duration' => $this->rental_duration,
        'rental_rate' => $this->rental_rate,
        'length' => $this->length,
        'replacement_cost' => $this->replacement_cost,
        'rating' => $this->rating,
        'special_features' => $this->special_features,
        ];
    }
}
