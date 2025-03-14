<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Film;
use App\Models\Critic;

class FilmCriticTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_critics_of_film(): void
    {
        $this->seed();

        $film = Film::find(1);
        $response = $this->get("/api/films/{$film->id}/critics");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'title' => $film->title,
            'description' => $film->description,
            'release_year' => $film->release_year,
            'language_id' => $film->language_id,
            'original_language_id' => $film->original_language_id,
            'rental_duration' => $film->rental_duration,
            'rental_rate' => $film->rental_rate,
            'length' => $film->length,
            'replacement_cost' => $film->replacement_cost,
            'rating' => $film->rating,
            'special_features' => $film->special_features,
        ]);

        $critics = $film->critics;
        $response->assertJsonCount($critics->count(), 'critics');
        foreach ($critics as $critic) {
            $response->assertJsonFragment([
                'user_id' => $critic->user_id,
                'film_id' => $critic->film_id,
                'score' => $critic->score,
                'comment' => $critic->comment,
            ]);
        }
    }

    public function test_get_critics_of_film_with_invalid_id(): void
    {
        $this->seed();

        $response = $this->get('/api/films/9999/critics');
        $response->assertStatus(404);
    }
}