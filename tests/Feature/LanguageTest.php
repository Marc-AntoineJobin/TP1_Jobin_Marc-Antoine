<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TestLanguageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function testGetLanguages(): void
    {
        $this->seed();

        $response = $this->get('/api/languages');

        $languagesArray = json_decode($response->getContent(), true);

        for($i = 0; $i < count($languagesArray['data']); $i++) {
            $response->assertJsonFragment([
                'name' => $languagesArray['data'][$i]['name'],
            ]);
        }
        $response->assertStatus(200);
    }

    public function testGetLanguage(): void
    {
        $response = $this->get('/api/languages/1');
        $language = json_decode($response->getContent(), true);

        $response->assertJsonFragment($language);
        $response->assertStatus(200);
    }

    public function testGetLanguagesShouldReturn422WhenMissingField()
    {
        $response = $this->postJson('/api/languages', [
        ]);

        $response->assertStatus(422);
    }

    public function testgetLanguageByIdShouldReturn404WhenInvalidId()
    {
        $response = $this->get('/api/languages/1000');

        $response->assertStatus(404);
    }
}
