<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Film;
use App\Models\Actor;

class ActorFilmTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_actors_of_film(): void
    {
        $this->seed();

        $film = Film::find(1);
        $response = $this->get("/api/films/{$film->id}/actors");

        $response->assertStatus(200);
        $actors = $film->actors;
        $response->assertJsonCount($actors->count());
        foreach ($actors as $actor) {
            $response->assertJsonFragment([
                'id' => $actor->id,
                'first_name' => $actor->first_name,
                'last_name' => $actor->last_name,
            ]);
        }
    }

    public function test_get_actors_of_film_with_invalid_id(): void
    {
        $this->seed();

        $response = $this->get('/api/films/9999/actors');
        $response->assertStatus(404);
    }
}