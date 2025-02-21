<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilmTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_post_film(): void
    {
        $this->seed();

        $json = [
            'title' => 'The Lord of the Rings',
            'rental_duration' => 5,
            'rental_rate' => 2.99,
            'replacement_cost' => 19.99,
            'language_id' => 1,
        ];

        $response = $this->postJson('/api/films', $json);

        $response->assertJsonFragment($json);
        $response->assertStatus(201);
    }

    public function test_get_films(): void
    {
        $this->seed();

        $response = $this->get('/api/films');

        $filmsArray = json_decode($response->getContent(), true);
        $this->assertEquals(count($filmsArray['data']), 10); // ????

        for($i = 0; $i < count($filmsArray['data']); $i++) {
            $response->assertJsonFragment([
                'title' => $filmsArray['data'][$i]['title'],
                'rental_duration' => $filmsArray['data'][$i]['rental_duration'],
                'rental_rate' => $filmsArray['data'][$i]['rental_rate'],
                'replacement_cost' => $filmsArray['data'][$i]['replacement_cost'],
            ]);
        }
        $response->assertStatus(OK);
    }

    public function test_get_film(): void
    {
        $this->seed();

        $response = $this->get('/api/films/1');
        $film = json_decode($response->getContent(), true);

        $response->assertJsonFragment($film);
        $response->assertStatus(200);
    }

    public function test_post_film_should_return_422_when_missing_field()
    {
        $response = $this->postJson('/api/Films', [
            'rental_duration' => 5,
            'rental_rate' => 2.99,
            'replacement_cost' => 19.99,
        ]);

        $response->assertStatus(422);
    }

    public function test_get_film_by_id_should_return_404_when_invalid_id()
    {
        $response = $this->get('/api/Films/1000');

        $response->assertStatus(404);
    }
}
