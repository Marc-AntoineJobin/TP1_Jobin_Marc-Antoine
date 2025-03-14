<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user(): void
    {
        $this->seed();

        $json = [
            'first_name' => 'Joe',
            'last_name' => 'Blow',
            'email' => 'joe.blow@test.com',
            'password' => 'password',
            'login' => 'joeblow'
        ];

        $response = $this->postJson('/api/users', $json);

        $response->assertJsonFragment([
            'first_name' => 'Joe',
            'last_name' => 'Blow',
            'email' => 'joe.blow@test.com',
            'login' => 'joeblow'
        ]);
        $response->assertStatus(201);
    }

    public function test_update_user(): void
    {
        $this->seed();

        $user = User::find(1);
        $this->assertNotNull($user, 'User not found in the database.');

        $json = [
            'first_name' => 'Ja',
            'last_name' => 'Bla',
            'email' => 'ja.bla@test.com',
            'login' => 'jabla'
        ];

        $response = $this->putJson("/api/users/{$user->id}", $json);

        $response->assertJsonFragment([
            'first_name' => 'Ja',
            'last_name' => 'Bla',
            'email' => 'ja.bla@test.com',
            'login' => 'jabla'
        ]);
        $response->assertStatus(200);
    }

    //TODO marche pas
    public function test_create_user_with_invalid_data(): void
    {
        $this->seed();

        $json = [
            'first_name' => '',
            'last_name' => '',
            'email' => 'invalid-email',
            'password' => '',
            'login' => ''
        ];

        $response = $this->postJson('/api/users', $json);

        $response->assertStatus(422);
    }

    public function test_update_user_with_invalid_data(): void
    {
        $this->seed();

        $user = User::find(1);
        $this->assertNotNull($user, 'User not found in the database.');

        $json = [
            'first_name' => '',
            'last_name' => '',
            'email' => 'invalid-email',
            'login' => ''
        ];

        $response = $this->putJson("/api/users/{$user->id}", $json);

        $response->assertStatus(422);
    }

    public function test_update_user_with_invalid_id(): void
    {
        $this->seed();

        $json = [
            'first_name' => 'Joe',
            'last_name' => 'Blow',
            'email' => 'joe.blow@example.com',
            'login' => 'joeblow'
        ];

        $response = $this->putJson('/api/users/9999', $json);

        $response->assertStatus(404);
    }
}